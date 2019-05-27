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

class Alma_Installments_Helper_Data extends Mage_Core_Helper_Abstract {

    /** @var \Alma\API\Entities\Merchant */
    private $merchant = null;
    /** @var \Alma\API\Client $alma */
    private $alma;
    /** @var \Psr\Log\LoggerInterface $logger */
    private $logger;

    public function __construct()
    {
        $this->alma = Mage::helper('alma/AlmaClient')->getDefaultClient();
        $this->logger = Mage::helper('alma/Logger')->getLogger();
    }

    /**
     * @param bool $force
     * @return \Alma\API\Entities\Merchant
     */
    public function getMerchant($force = false)
    {
        if ($this->alma && (!$this->merchant || $force)) {
            try {
                $this->merchant = $this->alma->merchants->me();
            } catch (\Exception $e) {
                $this->logger->warning('Could not fetch merchant information for PNX min/max amounts');
            }
        }

        return $this->merchant;
    }
}