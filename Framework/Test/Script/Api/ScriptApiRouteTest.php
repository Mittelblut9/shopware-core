<?php declare(strict_types=1);

namespace Shopware\Core\Framework\Test\Script\Api;

use PHPUnit\Framework\TestCase;
use Shopware\Core\Content\Test\Product\ProductBuilder;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Test\App\AppSystemTestBehaviour;
use Shopware\Core\Framework\Test\IdsCollection;
use Shopware\Core\Framework\Test\TestCaseBase\AdminApiTestBehaviour;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Symfony\Component\HttpFoundation\Response;

class ScriptApiRouteTest extends TestCase
{
    use IntegrationTestBehaviour;
    use AppSystemTestBehaviour;
    use AdminApiTestBehaviour;

    public function testApiEndpoint(): void
    {
        $this->loadAppsFromDir(__DIR__ . '/_fixtures');

        $browser = $this->getBrowser();
        $browser->request('POST', '/api/script/simple-script');

        $response = \json_decode($browser->getResponse()->getContent(), true);
        static::assertSame(Response::HTTP_OK, $browser->getResponse()->getStatusCode(), print_r($response, true));

        $traces = $this->getScriptTraces();
        static::assertArrayHasKey('api-simple-script', $traces);
        static::assertCount(1, $traces['api-simple-script']);
        static::assertSame('some debug information', $traces['api-simple-script'][0]['output'][0]);

        static::assertArrayHasKey('foo', $response);
        static::assertEquals('bar', $response['foo']);
    }

    public function testRepositoryCall(): void
    {
        $this->loadAppsFromDir(__DIR__ . '/_fixtures');

        $ids = new IdsCollection();

        $products = [
            (new ProductBuilder($ids, 'p1'))->price(100)->build(),
            (new ProductBuilder($ids, 'p2'))->price(200)->build(),
        ];

        $this->getContainer()->get('product.repository')->create($products, Context::createDefaultContext());

        $criteria = [
            'filter' => [
                ['type' => 'equals', 'field' => 'productNumber', 'value' => 'p1'],
            ],
            'includes' => [
                'dal_entity_search_result' => ['elements'],
                'product' => ['id', 'productNumber'],
            ],
            'limit' => 1,
        ];

        $browser = $this->getBrowser();
        $browser->request('POST', '/api/script/repository-test', [], [], [], \json_encode($criteria));
        $response = \json_decode($browser->getResponse()->getContent(), true);

        static::assertSame(Response::HTTP_OK, $browser->getResponse()->getStatusCode());

        $expected = [
            'apiAlias' => 'api_repository-test_response',
            'products' => [
                'apiAlias' => 'dal_entity_search_result',
                'elements' => [
                    ['id' => $ids->get('p1'), 'productNumber' => 'p1', 'apiAlias' => 'product'],
                ],
            ],
        ];

        static::assertEquals($expected, $response);
    }

    public function testInsufficientPermissionException(): void
    {
        $this->loadAppsFromDir(__DIR__ . '/_fixtures');

        $browser = $this->getBrowser();
        $browser->request('POST', '/api/script/insufficient-permissions');

        $response = \json_decode($browser->getResponse()->getContent(), true);

        static::assertArrayHasKey('errors', $response);
        static::assertCount(1, $response['errors']);
        static::assertEquals('Internal Server Error', $response['errors'][0]['title']);
        static::assertStringContainsString('api-insufficient-permissions', $response['errors'][0]['detail']);
        static::assertStringContainsString('Missing privilege', $response['errors'][0]['detail']);
    }
}
