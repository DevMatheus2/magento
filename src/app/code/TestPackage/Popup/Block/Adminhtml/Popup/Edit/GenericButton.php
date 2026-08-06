<?php
declare(strict_types=1);
namespace TestPackage\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * Undocumented function
     *
     * @param UrlInterface $url
     * @param RequestInterface $request
     * @param Escaper $escaper
     */
    public function __construct(
        private readonly UrlInterface $url,
        private readonly RequestInterface $request,
        private readonly Escaper $escaper,
    ) {}

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getPopupId(): int
    {
        return (int) $this->request->getParam('popup_id', 0);
    }

    /**
     * Undocumented function
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }

    /**
     * Undocumented function
     *
     * @return Escaper
     */
    public function getEscaper(): Escaper
    {
        return $this->escaper;
    }
}
