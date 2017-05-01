<?php

namespace app\models\wizflow;

use raoul2000\workflow\source\file\IWorkflowDefinitionProvider;

class Wizflow implements IWorkflowDefinitionProvider
{
	public function getDefinition()
	{
		return [
			'initialStatusId' => 'welcome',
			'status' => [
				'welcome' => [
					'transition' => ['step1'],
					'metadata' => [
						'model' => [
							'class' => '\app\models\wizflow\WelcomeForm'
						],
						'view' =>'step-welcome'
					]
				],
				'step1' => [
					'transition' => ['blue','green'],
					'metadata' => [
						'model' => [
							'class' => '\app\models\wizflow\Step1Form'
						],
						'view' =>'step-1'
					]					
				],
				'blue' => [
					'transition' => ['final'],
					'metadata' => [
						'model' => [
							'class' => '\app\models\wizflow\BlueForm'
						],
						'view' =>'step-blue'
					]
				],
				'green' => [
					'transition' => ['final'],
					'metadata' => [
						'model' => [
							'class' => '\app\models\wizflow\GreenForm'
						],
						'view' =>'step-green'
					]					
				],
				'final' => [
					'transition' => [],
					'metadata' => [
						'model' => [
							'class' => '\app\models\wizflow\FinalForm'
						],
						'view' =>'step-final'
					]
				]
			]
		];
	}
}