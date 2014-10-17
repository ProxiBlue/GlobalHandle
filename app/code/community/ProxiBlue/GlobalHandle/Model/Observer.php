class ProxiBlue_GlobalHandle_Model_Observer {


    public function controller_action_layout_load_before($observer) {
	try {
	    /** @var $layout Mage_Core_Model_Layout */
	    $layout = $observer->getEvent()->getLayout();
	    // do we have an active product. if so do not inject
	    if (!mage::registry('current_product')) {
		// do we have an active category?
		$category = mage::registry('current_category');
		if($category instanceof Mage_Catalog_Model_Category) {
		    $name = str_replace(' ', '_', strtolower($category->getName()));
		    $layout->getUpdate()->addHandle('CATEGORY_'.$name);
		}
	    }
	    $cmsPageUrlKey = Mage::getSingleton('cms/page')->getIdentifier();
	    if($cmsPageUrlKey){
		$name = str_replace('-', '_', strtolower($cmsPageUrlKey));
		$layout->getUpdate()->addHandle('CMS_'.$name);
	    }
	    $layout->getUpdate()->addHandle('GLOBAL_OVERRIDE');
	} catch (Exception $e) {
	    mage::logException($e);
	}
	return $this;
    }

}