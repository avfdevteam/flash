<?php 

namespace Laracasts\Flash;

class FlashNotifier {

    /**
     * @var SessionStore
     */
    private $session;

    /**
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * @param $message
     * @param $title
     */
    public function info($message, $title = 'Info')
    {
        $this->message($message, 'info', $title);
    }

    /**
     * @param $message
     * @param $title
     */
    public function success($message, $title = 'Success')
    {
        $this->message($message, 'success', $title);
    }

    /**
     * @param $message
     * @param $title
     */
    public function error($message, $title = 'Error')
    {
        $this->message($message, 'danger', $title);
    }

    /**
     * @param $message
     * @param $title
     */
    public function warning($message, $title = 'Warning')
    {
        $this->message($message, 'warning', $title);
    }

    /**
     * @param $message
     * @param $title
     */
    public function overlay($message, $title = 'Notice')
    {
        $this->message($message, 'info', $title);
        $this->session->flash('flash_notification.overlay', true);
        $this->session->flash('flash_notification.title', $title);
    }

    /**
     * @param $message
     * @param string $level
     */
    public function message($message, $level = 'info', $title = 'Notice')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
        $this->session->flash('flash_notification.title', $title);
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important()
    {
        $this->session->flash('flash_notification.important', true);

        return $this;
    }

    /**
     * Allows adding named parameters to flash messages
     * @param $params an array of parameters
     * @return $this
     */
    public function parameters($params)
    {
        //Guarantee an associative array
        if( ! is_array($params)) {
            $params = compact($params);
        }

        $this->session->flash('flash_notification.params', $params);

        return $this;
    }
}

