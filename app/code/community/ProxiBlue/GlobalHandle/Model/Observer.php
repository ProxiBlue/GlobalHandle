<?php

class ProxiBlue_GlobalHandle_Model_Observer
{

    /**
     * Inject handles into page display
     *
     * 'CATEGORY_<NAME_OF_CATEGORY>'
     * 'CMS_<CMS_PAGE_NAME>'
     * 'GLOBAL_OVERRIDE'
     *
     * DYNAMIC:
     * Uses GET/POST param called 'dynamic to inject a dynamic generated handle
     * '<DYNAMIC_VAR>_dynamic-handle'
     *
     * @param $observer
     *
     * @return $this
     */
    public function controller_action_layout_load_before($observer)
    {
        try {
            /** @var $layout Mage_Core_Model_Layout */
            $layout = $observer->getEvent()->getLayout();
            // do we have an active product.
            if (!mage::registry('current_product')) {
                // do we have an active category?
                $category = mage::registry('current_category');
                if ($category instanceof Mage_Catalog_Model_Category) {
                    $name = str_replace(' ', '_', strtolower($category->getName()));
                    $urlKey = str_replace('-', '_', strtolower($category->getUrlKey()));
                    $layout->getUpdate()->addHandle('CATEGORY_' . $name);
                    $layout->getUpdate()->addHandle('CATEGORY_' . $urlKey);
                    // inject custom page layout handle
                    // ref: http://stackoverflow.com/questions/20249894/magento-1-7-how-to-use-the-page-layout-handle
                    $design = Mage::getSingleton('catalog/design');
                    $settings = $design->getDesignSettings($category);
                    if($settings->getPageLayout()) {
                        $layout->getUpdate()->addHandle($settings->getPageLayout());
                    }
                }
            }

            // inject CMS page name
            $cmsPageUrlKey = Mage::getSingleton('cms/page')->getIdentifier();
            if ($cmsPageUrlKey) {
                $name = str_replace('-', '_', strtolower($cmsPageUrlKey));
                $layout->getUpdate()->addHandle('CMS_' . $name);
            }

            // inject via dynamic GET/POST variable
            $request = Mage::app()->getRequest();
            if (is_object($request) && $dynamic = $request->getParam('dynamic')) {
                //inject a layout handle to allow adjust of page with custom layout xml
                $layout->getUpdate()->addHandle($dynamic . '_dynamic_handle');
            }

            $layout->getUpdate()->addHandle('GLOBAL_OVERRIDE');
        } catch (Exception $e) {
            mage::logException($e);
        }

        return $this;
    }

}