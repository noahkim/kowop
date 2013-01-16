<?php

class RequestJoinForm extends CFormModel
{
    public $user_ID;
    public $request_ID;
    public $availability;

    public function rules()
    {
        return array(
            array('userID, requestID, availability', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array();
    }

    public function save()
    {
        $hasSpecifiedAvailability = false;

        if ($this->availability != null)
        {
            foreach ($this->availability as $day => $timeOfDay)
            {
                if ($timeOfDay == 0)
                {
                    continue;
                }

                $hasSpecifiedAvailability = true;

                $existing = RequestToUser::model()->find(
                    'User_ID=:User_ID AND Request_ID=:Request_ID AND Day=:Day',
                    array(':User_ID' => $this->user_ID, ':Request_ID' => $this->request_ID, ':Day' => $day)
                );
                if ($existing == null)
                {
                    $requestToUser = new RequestToUser();
                    $requestToUser->User_ID = $this->user_ID;
                    $requestToUser->Request_ID = $this->request_ID;
                    $requestToUser->Day = $day;
                    $requestToUser->Time_of_day = $timeOfDay;

                    $requestToUser->save();
                }
            }
        }

        if (!$hasSpecifiedAvailability)
        {
            $requestToUser = new RequestToUser();
            $requestToUser->User_ID = $this->user_ID;
            $requestToUser->Request_ID = $this->request_ID;

            $requestToUser->save();
        }

        $request = Request::model()->findByPk($this->request_ID);
        $user = User::model()->findByPk($this->user_ID);

        Message::SendNotification($request->Create_User_ID, "{$user->fullName} has joined your class request \"{$request->Name}\".");
    }
}
