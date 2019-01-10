<?php
/**
 * 2018 Alma / Nabla SAS
 *
 * THE MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @author    Alma / Nabla SAS <contact@getalma.eu>
 * @copyright 2018 Alma / Nabla SAS
 * @license   https://opensource.org/licenses/MIT The MIT License
 *
 */

class Alma_Installments_Model_System_Config_Backend_APIKeyValue extends Mage_Adminhtml_Model_System_Config_Backend_Encrypted
{
    protected $apiKeyType = null;
    protected $apiKeyName = null;

    /**
     * @throws Exception
     */
    protected function _beforeSave()
    {
        $value = (string)$this->getValue();

        if (empty($value)) {
            throw new Exception(Mage::helper('adminhtml')->__('API key is required'));
        }

        $genericError = new Exception(Mage::helper('adminhtml')->__("Error checking {$this->getApiKeyName()}"));

        /** @var Alma_Installments_Helper_Availability $availabilityHelper */
        $availabilityHelper = Mage::helper('alma/availability');

        if (!$availabilityHelper->canConnectToAlma($this->apiKeyType, $value)) {
            throw $genericError;
        }

        parent::_beforeSave();
    }

    protected function _afterSave()
    {
        $result = parent::_afterSave();
        Mage::dispatchEvent('alma_saved_api_key', array('mode' => $this->apiKeyType));
        return $result;
    }

    public function getApiKeyName()
    {
        return Mage::helper('adminhtml')->__('API key');
    }
}
