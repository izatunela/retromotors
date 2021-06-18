<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\DomCrawler\Crawler;

class AjaxRequest
{
	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);

		if (!$response->isRedirection() && $request->ajax()) {
			$crawler = new Crawler($response->getContent());
			$response_html = $crawler->filter('#ajax-content')->html();
			$response_css = $crawler->filter('.content-css')->each(function (Crawler $node, $i) {
    				return $node->attr('href');
    			});
			$response_js = $crawler->filter('.content-js')->each(function (Crawler $node, $i) {
    				return $node->attr('src');
    			});

			if (empty($response_css)) {
				$response_css = '';
			}
			if (empty($response_js)) {
				$response_js = '';
			}

			$response->setContent(
				[
					'content_css' 	=> $response_css,
					'content_js' 	=> $response_js,
					'html' 			=> $response_html
				]);
		}
		return $response;
	}
}
