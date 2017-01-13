<?php
namespace MisaCore\Domain\Base\Dto;

/**
 * PaginatorDto Class
 *
 * @package MisaCore\Domain
 * @subpackage MisaCore\Domain\Base\Dto
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class PaginatorDto
{
    /** @var  array */
    private $itemsByPage;

    /** @var  \stdClass */
    private $pages;

    /** @var  int */
    private $total;

    /** @var  int */
    private $currentPage;

    /**
     * PaginatorDto constructor.
     * @param $itemsByPage
     * @param \stdClass $pages
     * @param int $total
     * @param int $currentPage
     */
    public function __construct($itemsByPage, \stdClass $pages, $total, $currentPage)
    {
        $this->itemsByPage = [];
        foreach ($itemsByPage as $row) {
            $this->itemsByPage[] = $row;
        }
        $this->pages = $pages;
        $this->total = $total;
        $this->currentPage = $currentPage;
    }


    /**
     * @return array
     */
    public function getItemsByPage()
    {
        return $this->itemsByPage;
    }

    /**
     * @return \stdClass
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function toArray()
    {
        return [
            'items' => $this->getItemsByPage(),
            'pages' => $this->getPages(),
            'total' => $this->getTotal(),
            'currentPage' => $this->getCurrentPage()
        ];
    }
}
