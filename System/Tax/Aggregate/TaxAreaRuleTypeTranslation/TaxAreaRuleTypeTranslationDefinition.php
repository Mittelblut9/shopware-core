<?php declare(strict_types=1);

namespace Shopware\Core\System\Tax\Aggregate\TaxAreaRuleTypeTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Tax\Aggregate\TaxAreaRuleType\TaxAreaRuleTypeDefinition;

class TaxAreaRuleTypeTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'tax_area_rule_type_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return TaxAreaRuleTypeTranslationCollection::class;
    }

    public function getEntityClass(): string
    {
        return TaxAreaRuleTypeTranslationEntity::class;
    }

    protected function getParentDefinitionClass(): string
    {
        return TaxAreaRuleTypeDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('type_name', 'typeName'))->addFlags(new Required()),
        ]);
    }
}
