<?php

class ProxiBlue_GlobalHandle_Model_Observer {

   
    public function controller_action_layout_load_before($observer) {
        try {
            /** @var $layout Mage_Core_Model_Layout */
            $layout = $observer->getEvent()->getLayout();
            $layout->getUpdate()->addHandle('GLOBAL_OVERRIDE');
        } catch (Exception $e) {
            mage::logException($e);
        }
        return $this;
    }

}
