<?php

	class SubscriptionModel extends Model
	{
		protected $table = 'subscriptions';

		public function getByCar($carId)
		{
			return $this->getRow([
				'car_id' => $carId
			]);
		}
	}