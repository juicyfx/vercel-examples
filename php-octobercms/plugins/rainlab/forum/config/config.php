<?php return [
      /*
      |--------------------------------------------------------------------------
      | User Topic Creation Throttle: Max Topics Count
      |--------------------------------------------------------------------------
      |
      | Prevent a given user from creating more than 'n' topics for a provided timeframe
      |
      | (Works alongside throttleMinutes to restrict a user to throttleCount per throttleMinutes)
      |
      */
    'throttleCount' => 2,

      /*
      |--------------------------------------------------------------------------
      | User Topic Creation Throttle: Timeframe
      |--------------------------------------------------------------------------
      |
      | Time, in minutes, to consider when throttling a users' topic creation.
      |
      | (Works alongside throttleCount to restrict a user to throttleCount per throttleMinutes)
      |
      */
    'throttleMinutes' => 15,
];