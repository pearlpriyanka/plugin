<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.test
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\Event\SubscriberInterface;

class PlgSystemTest extends CMSPlugin implements SubscriberInterface
{
    /**
	 * Load the language file on instantiation
	 *
	 * @var    boolean
	 */
    protected $autoloadLanguage = true;
    /**
     * The text to be displayed
     * 
     * @var     String
     */
    protected $displayText;
    /**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 */
    protected $app;
    

    public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
        $this->displayText = $this->params->get('headlineText');

	}

    public static function getSubscribedEvents(): array
	{
		return [
			'onBeforeCompileHead' => 'onBeforeCompileHead'
		];
	}

    /**
	 * Listener for the `onBeforeCompileHead` event
	 *
	 * @return  void
	 */
    public function onBeforeCompileHead()
    {
        if ($this->app->isClient('administrator'))
        {
            $document = Factory::getDocument();
            $document->addScriptOptions('plg_system_headline', array(
                'displaytext' => $this->displayText
            ));
            $document->addScript('/joomla-cms/plugins/system/headline/headline.js');
        }
    }
}