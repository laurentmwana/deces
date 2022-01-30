<?php

namespace App;

/**
 * Message flash
 */
class FlashMessage {

    /**
     * Enrregistrer les messagges
     * 
     * @var array
     */
    private $message = [];

    /**
     * FlashMessage Constructor 
     * 
     * @param array $message
     */
    public function __construct($message = [])
    {
        $this->message = $message;
    }

    /**
     * Générer l'HTML en affichant le message qui correspond (success, danger, warning...)
     * @return string
     */
    public function message (): string {
        $message = "";
        if (!empty($this->message)) {
            $li = "";
            foreach ($this->message as $key => $value) {
                if (is_array($value) && !empty($value)) {
                    foreach ($value as $v) {
                        $message .= <<< HTML
                            <li> {$v} </li>
                        HTML;
                    }
                } else {
                    $message .= <<< HTML
                        <li> {$value} </li>
                    HTML;
                }
                $keys = $key;
                
            }
        }
        if (!empty($message)) {
            return <<< HTML

            <div class="message message-{$keys}">
                <ul>
                    {$message}
                </ul>
            </div>
            HTML;
        }

        return $message;
        

       
    }
}
