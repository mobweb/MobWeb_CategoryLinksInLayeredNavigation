<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Filter item model
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class MobWeb_CategoryLinksInLayeredNavigation_Model_Layer_Filter_Item extends Mage_Catalog_Model_Layer_Filter_Item
{
    public function getUrl()
    {
        // Check if the current filter is for a category
        if($this->getFilter()->getRequestVar() == "cat"){
            // Get the category's URL
            $categoryUrl = Mage::getModel('catalog/category')->load($this->getValue())->getUrl();

            // Get the current URL
            $request = Mage::getUrl('*/*/*', array('_current'=>true, '_use_rewrite'=>true));

            // If the current URL contains a parameter, extract it
            if(strpos($request,'?') !== false ){
                $queryString = substr($request, strpos($request, '?'));
            }

            // If a parameter exists, append it to the category URL
            if(isset($queryString) && $queryString){
                $categoryUrl .= $queryString;
            }

            // Return the category URL, instead of the filter URL
            return $categoryUrl;
        } else {
            // If not, simply run the parent method
            return parent::getUrl();
        }
    }
}