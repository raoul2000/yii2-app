<?php
namespace app\models\history;

use Yii;
use raoul2000\workflow\source\file\IWorkflowDefinitionProvider;

class PostWorkflow implements IWorkflowDefinitionProvider 
{
	public function getDefinition() {
		return [
			'initialStatusId' => 'draft',
			'status' => [
				'draft' => [
					'transition' => ['correction'],
					'metadata' => [
						'color' => 'rgb(171, 171, 171)'
					]
				],
				'correction' => [
					'transition' => ['draft','ready'],
					'metadata' => [
						'color' => 'rgb(226, 144, 27)'
					]					
				],
				'ready' => [
					'transition' => ['draft', 'correction', 'published']
				],
				'published' => [
					'transition' => ['ready', 'archived'],
					'metadata' => [
						'color' => 'rgb(104, 196, 102)'
					]
				],
				'archived' => [
					'transition' => ['ready']
				]
			]
		];
	}
}