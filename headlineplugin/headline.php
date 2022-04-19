<?php

defined( '_JEXEC' ) || die( 'Access Deny' );                             

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;


class PlgSystemheadingplugins extends JPlugin
{
	
	protected $app;
	

	public function __construct($name, array $arguments = array())
	{
		$this->loadLanguage('plg_system_headline');
		parent::__construct($name, $arguments);
	}
	public function onBeforeCompileHead()												
	{		try
		{
			$app = Factory::getApplication();
		}
		catch (Exception $e)
		{
			die('Fail');
		}
		$document = JFactory::getDocument();
		$content= $app->getBody();
		$replace = $this->params->get('Input','Joomla');

	
		if(JFactory::getApplication()->isClient('administrator')){						

			if (preg_match_all('/(<h.*?)(class *= *"|\')(.*)("|\')(.*>)/is', $content, $matches))
				{
					
					$content = preg_replace(
						'/(<h.*?)(class *= *"|\')(.*)("|\')(.*>)/is',
						'<h1>'.$replace.'</h1>',
						$content);
				} 
			elseif (preg_match_all('/(<h.*?)(.*>)/is', $content, $matches))
				{
					$content = preg_replace(
						'/(<h.*?)(.*>)/is',
						'<h1>'.$replace.'</h1>',
						$content);
				}
		}
		if(count((array)$content) > 1){								
			JFactory::getApplication()->setBody($content);
			return;
		}
		
		if(JFactory::getApplication()->isClient('administrator')){	
            JFactory::getDocument()->addScriptDeclaration('
			document.addEventListener("DOMContentLoaded", (event) => {
				let h1Headlines= document.querySelectorAll("h1, h2, h3, h4, h5, h6");
				for(var i=0;i<h1Headlines.length;i++){
					h1Headlines[i].innerText += "'.$replace.' ";
				}
		  	})
        ');
		}
	}
}