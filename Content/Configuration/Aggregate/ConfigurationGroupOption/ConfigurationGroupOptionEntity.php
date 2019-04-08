<?php declare(strict_types=1);

namespace Shopware\Core\Content\Configuration\Aggregate\ConfigurationGroupOption;

use Shopware\Core\Content\Configuration\Aggregate\ConfigurationGroupOptionTranslation\ConfigurationGroupOptionTranslationCollection;
use Shopware\Core\Content\Configuration\ConfigurationGroupEntity;
use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Content\Product\Aggregate\ProductConfiguratorSetting\ProductConfiguratorSettingCollection;
use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class ConfigurationGroupOptionEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected $groupId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var string|null
     */
    protected $colorHexCode;

    /**
     * @var string|null
     */
    protected $mediaId;

    /**
     * @var ConfigurationGroupEntity|null
     */
    protected $group;

    /**
     * @var ConfigurationGroupOptionTranslationCollection|null
     */
    protected $translations;

    /**
     * @var ProductConfiguratorSettingCollection|null
     */
    protected $productConfigurators;

    /**
     * @var ProductCollection|null
     */
    protected $productDatasheets;

    /**
     * @var ProductCollection|null
     */
    protected $productOptions;

    /**
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;

    /**
     * @var MediaEntity|null
     */
    protected $media;

    /**
     * @var array|null
     */
    protected $attributes;

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function setGroupId(string $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getColorHexCode(): ?string
    {
        return $this->colorHexCode;
    }

    public function setColorHexCode(?string $colorHexCode): void
    {
        $this->colorHexCode = $colorHexCode;
    }

    public function getMediaId(): ?string
    {
        return $this->mediaId;
    }

    public function setMediaId(?string $mediaId): void
    {
        $this->mediaId = $mediaId;
    }

    public function getGroup(): ?ConfigurationGroupEntity
    {
        return $this->group;
    }

    public function setGroup(ConfigurationGroupEntity $group): void
    {
        $this->group = $group;
    }

    public function getTranslations(): ?ConfigurationGroupOptionTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(ConfigurationGroupOptionTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    public function getProductConfigurators(): ?ProductConfiguratorSettingCollection
    {
        return $this->productConfigurators;
    }

    public function setProductConfigurators(ProductConfiguratorSettingCollection $productConfigurators): void
    {
        $this->productConfigurators = $productConfigurators;
    }

    public function getProductDatasheets(): ?ProductCollection
    {
        return $this->productDatasheets;
    }

    public function setProductDatasheets(ProductCollection $productDatasheets): void
    {
        $this->productDatasheets = $productDatasheets;
    }

    public function getProductOptions(): ?ProductCollection
    {
        return $this->productOptions;
    }

    public function setProductOptions(ProductCollection $productOptions): void
    {
        $this->productOptions = $productOptions;
    }

    public function getMedia(): ?MediaEntity
    {
        return $this->media;
    }

    public function setMedia(?MediaEntity $media): void
    {
        $this->media = $media;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    public function setAttributes(?array $attributes): void
    {
        $this->attributes = $attributes;
    }
}
