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
					'label' => 'draft',
					'transition' => ['correction'],
					'metadata' => [
						'color' => 'rgb(171, 171, 171)'
					]
				],
				'correction' => [
					'transition' => ['draft','ready'],
					'metadata' => [
						'color' => '#ff9966'
					]
				],
				'ready' => [
					'transition' => ['draft', 'correction', 'published'],
					'metadata' => [
						'color' => '#00ccff'
					]

				],
				'published' => [
					'transition' => ['ready', 'archived'],
					'metadata' => [
						'color' => 'rgb(104, 196, 102)'
					]
				],
				'archived' => [
					'transition' => ['ready'],
					'metadata' => [
						'color' => '#cc99ff'
					]
				]
			]
		];
	}
}
