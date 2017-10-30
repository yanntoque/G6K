<?php

/*
The MIT License (MIT)

Copyright (c) 2015 Jacques Archimède

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

namespace EUREKA\G6KBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Finder\Finder;

use EUREKA\G6KBundle\Manager\ControllersHelper;

use Silex\Application;
use Binfo\Silex\MobileDetectServiceProvider;

/**
 *
 * The HomeAdminController class is the controller that display the administration interface homepage.
 *
 * @author Jacques Archimède
 *
 */
class HomeAdminController extends BaseAdminController {

	/**
	 * @var \SimpleXMLElement $datasources content of Datasources.xml
	 *
	 * @access  private
	 *
	 */
	private $datasources = null;

	/**
	 * Entry point of the root path /admin
	 *
	 * @access  public
	 * @param   \Symfony\Component\HttpFoundation\Request $request The request
	 * @return  \Symfony\Component\HttpFoundation\Response The administration interface homepage in a Response object
	 *
	 */
	public function indexAction(Request $request)
	{
		$this->helper = new ControllersHelper($this, $this->container);
		return $this->runIndex($request);
	}

	/**
	 * Prepare the administration interface homepage and renders it.
	 *
	 * @access  protected
	 * @param   \Symfony\Component\HttpFoundation\Request $request The request
	 * @return  \Symfony\Component\HttpFoundation\Response The administration interface homepage in a Response object
	 *
	 */
	protected function runIndex(Request $request)
	{
		$no_js = $request->query->get('no-js') || 0;
		$script = $no_js == 1 ? 0 : 1;

		try {
			$this->datasources = new \SimpleXMLElement($this->databasesDir."/DataSources.xml", LIBXML_NOWARNING, true);
			$datasourcesCount = $this->datasources->DataSource->count();
		} catch (\Exception $e) {
			$datasourcesCount = 0;
		}

		$userManager = $this->get('fos_user.user_manager');
		$users = $userManager->findUsers();

		$finder = new Finder();
		$finder->depth('== 0')->files()->name('*.xml')->in($this->simulatorsDir);
		$simulatorsCount = $finder->count();

		$finder = new Finder();
		$finder->depth('== 0')->ignoreVCS(true)->exclude(array('admin', 'base', 'Theme'))->directories()->in($this->viewsDir);
		$viewsCount = $finder->count();

 		$hiddens = array();
		$hiddens['script'] = $script;
		$silex = new Application();
		$silex->register(new MobileDetectServiceProvider());
		try {
			return $this->render(
				'EUREKAG6KBundle:admin/pages:index.html.twig',
				array(
					'ua' => $silex["mobile_detect"],
					'path' => $request->getScheme().'://'.$request->getHttpHost(),
					'nav' => 'home',
					'datasourcesCount' => $datasourcesCount,
					'usersCount' => count($users),
					'simulatorsCount' => $simulatorsCount,
					'viewsCount' => $viewsCount,
					'hiddens' => $hiddens,
					'script' => $script,
					'simulator' => null,
					'view' => null
				)
		);
		} catch (\Exception $e) {
			echo $e->getMessage();
			throw $this->createNotFoundException($this->get('translator')->trans("This template does not exist"));
		}
	}
}

?>
