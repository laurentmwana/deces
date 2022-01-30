<?php


namespace App\HTML;

use App\Controller\Post;
use App\Validator\Validator;
use App\Validator\ValidatorException;

/**
 * Génére un champs automatiquement
 */
class Form {

    /**
     * @var array
     */
    private $dataOption = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var \App\Controller\Post
     */
    private $post;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $label;


    /**
     * @var array
     */
    private $type;

    /**
     * @var string
     */
    private $placeholder;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cols;

    /**
     * @var string
     */
    private $rows;

    /**
     * @var string
     */
    private $values;

    /**
     * @var string
     */
    private $attr;

    /**
     * @var array
     */
    private $actions = [];

    private $v = [];


    const FORMS = [
        "input" => 'input',
        "select" => 'select',
        "button" => "button",
        "textarea" => "textarea",
        "input.c" => "chekbox",
        "select-data" => "select-data"
    ];

    const TYPES = [
        "radio" => "radio",
        "checkbox" => 'checkbox',
        "text" => 'text',
        "number" => 'number',
        "date" => 'date'
    ];

    const BUTTONS = [
        "submit" => 'submit',
        "button" => 'button',
        "reset" => 'reset'
    ];

    /**
     * @param array $errors
     */
    public function __construct(array $errors = [])
    {
        
        $this->errors = $errors;
        $this->post = new Post;
        Post::method($_POST);
        

    }
    
    
    /**
     * @param string $form
     * 
     * @return self
     */
    public function form (string $form): self {
        $this->form = $form;
        return $this;
    }

    /**
     * @param mixed $cols
     * 
     * @return self
     */
    public function cols ($cols): self {
        if (is_null($this->cols)) {
            $this->cols = "";
        } else {
            $this->cols = $cols;
        }
        
        return $this;
    }

    private function getValue ($key): string {
        $post = new Post($_POST);
        $value = "";
        if (!is_null($this->values) && !isset($this->errors['danger'][$key]) && $post->emptyData()) {
            $value = $this->values;
        }
        
        if (!empty($this->values)) {
           $value = $this->values;
        }
        
        else {
            if (!$post->emptyData()) {
                $value = $post->get($key);
            } else {
                $value = "";
            }
        }


    
        return $value;
    }

    /**
     * @param bool $action
     * 
     * @return self
     */
    public function setError ($keys, bool $action = true): self {
        $this->actions[$keys] = $action;
        return $this;
    }


    /**
     * @param mixed $value
     * 
     * @return self
     */
    public function setValues ($value): self {

        $this->values = $value;
        return $this;
    }

    /**
     * @param mixed $value
     * 
     * @return self
     */
    public function setValue ($value): self {
        $this->value = $value;
        return $this;
    }

    /**
     * @param mixed $rows
     * 
     * @return self
     */
    public function rows ($rows): self {
        $this->rows = $rows;
        if (is_null($this->rows)) {
            $this->rows = "";
        }
        return $this;
    }

    /**
     * @param mixed $placeholder
     * 
     * @return self
     */
    public function placeholder ($placeholder): self {
        $this->placeholder = $placeholder;
        if (is_null($this->placeholder)) {
            $this->placeholder = "";
        }
        
        return $this;
    }

    /**
     * @param mixed $name
     * @param mixed $value
     * 
     * @return self
     */
    public function v ($name, $value): self {
        $this->v[$name] = $value;
        return $this;
    }


    /**
     * @param mixed $icon
     * 
     * @return self
     */
    public function icon ($icon): self {
        $this->icon = $icon;
        if (is_null($this->icon)) {
            $this->icon = "";
        } 
        
        return $this;
    }

    /**
     * @param mixed $label
     * 
     * @return self
     */
    public function label ($label): self {
        $this->label = $label;
        if (is_null($this->label)) {
            $this->label = "";
        }
        return $this;
    }

    /**
     * @param mixed $attr
     * 
     * @return self
     */
    public function attr ($attr): self {
        $this->attr = $attr;
        if (is_null($this->attr)) {
            $this->attr = "";
        } 
        
        return $this;
    }

    /**
     * @param mixed $name
     * 
     * @return self
     */
    public function name ($name): self {
        $this->name = $name;
        if (is_null($this->name)) {
            $this->name = "";
        }
        return $this;
    }

    /**
     * @param mixed $id
     * 
     * @return self
     */
    public function id ($id): self {
        $this->id = $id;
        if (is_null($this->id)) {
            $this->id = "";
        }
        return $this;
    }

    /**
     * @param mixed $type
     * 
     * @return self
     */
    public function type ($type): self {
        $this->type = $type;
        if (is_null($this->type)) {
            $this->type = "";
        }
        return $this;
    }

    /**
     * @param mixed $keys
     * @param mixed $value
     * 
     * @return self
     */
    public function option ($keys, $value): self {
        $this->options[$this->name][$keys] = $value;
        return $this;
    }

    /**
     * @param mixed $keys
     * @param mixed $label
     * @param array|object $data
     * 
     * @return self
     */
    public function dataOption ($keys, $data): self {
        $this->dataOption[$this->name][$keys] = $data;
        return $this;
    }

    /**
     * @param mixed $keys
     * @param mixed $label
     * @param mixed $id
     * @param mixed $attr
     * @param mixed $placeholder
     * @param string $values
     * 
     * @return string
     */
    public function selectData ($keys , $label, $id, $attr, $placeholder,   $values = ''): string {
        $option = <<< HTML
        <option value="" > {$this->placeholder} </option>
        HTML;

        if (!empty($this->dataOption) && !is_null($this->dataOption)) {
            $error = 0;
            $count = 0;
            $v = $this->v[$keys];

            

            foreach ($this->dataOption[$keys] as $alias => $options) {
                foreach ($options as $value) {
                    $select = "";
                    if ($this->getValue($keys) === $value->$v && !empty($this->getValue($keys))) {
                        $select = "selected";
                    }
                    $option .= <<< HTML
                    <option value="{$value->$v}" {$select}>{$value->$alias}</option>
                HTML;
                }
            }
            
        } 

        return <<< HTML
        <div class="input">
            <label for="{$id}" class="label-e">{$label}</label>
            <select name="{$keys}" id="{$keys}" class="input-e">{$option}</select>
            {$this->error($keys)}
        </div>            
    HTML;
    }

    /**
     * @param mixed $keys
     * @param mixed $label
     * @param mixed $id
     * @param mixed $attr
     * @param mixed $placeholder
     * @param string $values
     * 
     * @return string
     */
    private function select ($keys , $label, $id, $attr, $placeholder,   $values = ''): string {
        
        
        $option = <<< HTML
        <option value="" > {$placeholder} </option>
        HTML;
        if (!empty($this->options) && !is_null($this->options)) {
            $error = 0;
            $count = 0;

            foreach ($this->options[$keys] as $key => $value) {
                $count = count($this->options[$keys]);
                if ($this->getValue($keys) === $key && !empty($this->getValue($keys))) {
                    $v = "selected";
                    $error = $count;
                  
                } 

                else {
                    $v = "";
                }
                $v = $this->getValue($keys) === $key && !empty($this->getValue($keys)) ? "selected" : "";
                $option .= <<< HTML
                <option value="{$key}" {$v}>{$value}</option>
            HTML;
            }

            return <<< HTML
                <div class="input">
                    <label for="{$id}" class="label-e">{$label}</label>
                    <select name="{$keys}" id="{$keys}" class="input-e">{$option}</select>
                    {$this->error($keys)}
                </div>            
            HTML;
        } 

        return $option;
    }


    /**
     * @return string
     */
    public function generate (): string {
        if (isset(self::FORMS[$this->form])) {
            
            if ($this->form === 'input') {
                
                if ($this->type === 'checkbox')  {
                    return $this->checkbox(
                        $this->name,
                        $this->type,
                        $this->id,
                        $this->attr,
                        $this->getValue($this->name) 
                    );
                }
                
                return $this->input(
                    $this->name, 
                    $this->label,
                    $this->type,
                    $this->id,
                    $this->attr,
                    $this->placeholder,
                    $this->getValue($this->name)
                );
            } elseif ($this->form === 'select') {
                return $this->select(
                    $this->name, 
                    $this->label,
                    $this->id,
                    $this->attr,
                    $this->placeholder,
                    $this->getValue($this->name)
                );
            }

            elseif ($this->form === 'select-data') {
                return $this->selectData(
                    $this->name, 
                    $this->label,
                    $this->id,
                    $this->attr,
                    $this->placeholder,
                    $this->getValue($this->name)
                );
            }


            elseif ($this->form === 'button' && isset(self::BUTTONS[$this->type])) {
                return $this->button(
                    $this->type,
                    $this->name,
                    $this->id,
                    $this->attr,
                    $this->label,
                    $this->icon
                    
                );
            }

            elseif ($this->form === 'textarea') {
                return $this->textarea(
                    $this->name,
                    $this->label,
                    $this->id,
                    $this->attr,
                    $this->label,
                    $this->cols,
                    $this->rows,
                    $this->placeholder,
                    $this->getValue($this->name)
                    
                );
            }
        }

        return '';
    }

    /**
     * @param mixed $keys
     * @param mixed $label
     * @param mixed $type
     * @param mixed $id
     * @param string $placeholder
     * @param string $values
     * 
     * @return string
     */
    private function input ($keys , $label,  $type, $id, $attr,   $placeholder = '',  $values = ''): string {
        return <<< HTML
        <div class="input">
            <label for="{$id}" class="label-e">{$label}</label>
            <input type="{$type}" name="{$keys}"  placeholder="{$placeholder}" class="input-e" id="{$id}" value="{$values}" {$attr}>
            {$this->error($keys)}
        </div>
    HTML;
    }

   
    /**
     * @param mixed $type
     * @param mixed $name
     * @param mixed $id
     * @param mixed $attr
     * @param mixed $label
     * @param $icon =
     * 
     * @return string
     */
    private function button ($type, $name , $id, $attr, $label, $icon = 'fa fa-save'): string {
        return <<< HTML
        <div class="button-group"> 
            <button type="{$type}" class="link-dark input-b" name="{$name}" id="{$id}"><span class="{$icon}" {$attr}></span> {$label}</button>
        </div>
    HTML;
    }


    /**
     * @param mixed $name
     * @param mixed $label
     * @param mixed $id
     * @param mixed $attr
     * @param mixed $cols
     * @param mixed $rows
     * @param string $placeholder
     * @param string $values
     * 
     * @return string
     */
    private function textarea ($name, $label, $id, $attr, $cols, $rows,   $placeholder = '',  $values = ''): string {
        return <<< HTML
        <div class="input">
            <label for="{$id}" class="label-e">{$label}</label>
            <textarea class="textarea-e" name="{$name}" id="{$id}" cols="{$cols}" rows="{$rows}" value="{$values}" {$attr}></textarea>
            {$this->error($name)}
        </div>
    HTML;
    }


    /**
     * @param mixed $name
     * @param mixed $type
     * @param mixed $id
     * @param mixed $attr
     * @param mixed $value
     * 
     * @return string
     */
    private function checkbox ($name, $type,  $id, $attr, $value): string {
        return <<< HTML
        <input type="{$type}"  class="check" id="{$id}" value="{$value}" name="{$name}" {$attr}>
    HTML;
    }

    /**
     * @param mixed $key
     * 
     * @return string
     */
    private function error ($key): string {
        $error = "";
        if (isset($this->actions[$key])) {
            if ($this->actions[$key] === false) {
                return "";
            }
        } 
        if (isset($this->errors['danger']) && isset($this->errors['danger'][$key])) {
            $message = (string)$this->errors['danger'][$key];
            $error =  <<< HTML
            <div class="e errors"> <i class="fa fa-window-close"></i> {$message}</div>
            HTML;
        } else if ($this->post->status($key) && !empty($this->post->get($key))) {
            $error =  <<< HTML
            <div class="e success"> <i class="fa fa-check"></i> valider</div>
            HTML;
        }

        return $error;
        
    }
}

?>

