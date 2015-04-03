<?php


/**
 * Class MailWrapper
 */
class MailWrapper {
    /**
     *
     */
    const SUBJECT_TITLE = 'www.gde.ck.ua';

    /**
     * @var Users
     */
    private $model;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var string
     */
    private $to;
    /**
     * @var string
     */
    private $from = 'support@gde.ck.ua';

    /**
     * @var string
     */
    private $view;


    /**
     * @return mixed
     */
    public function send()
    {
        $message = new YiiMailMessage;
        $message->view = $this->getView();
        $message->setBody(['model' => $this->getModel()], 'text/html');
        $message->subject = self::SUBJECT_TITLE . ': ' . $this->getSubject();
        $message->addTo($this->getTo());
        $message->from = $this->getFrom();

        return Yii::app()->mail->send($message);
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return [
	        $this->from => Yii::t('main', 'Где в Чрекассах')
        ];
    }

    /**
     * @param \Users $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return \Users
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to ? $this->to : $this->getModel()->email;
    }

    /**
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }


} 