<?php

namespace App\Templator;

class FormTemplator
{
    /**
     * @return array
     */
    public static function getHorizontalFormTemplate()
    {
        return  [
            // Used for button elements in button().
            'button' => '<button{{attrs}}>{{text}}</button>',
            // Used for checkboxes in checkbox() and multiCheckbox().
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Input group wrapper for checkboxes created via control().
            'checkboxFormGroup' => '{{label}}',
            // Wrapper container for checkboxes.
            'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
            // Error message wrapper elements.
            'error' => '<div class="col-sm-3"></div><div class="col-sm-9"><input class="is-invalid" hidden><div class="error-message invalid-feedback mt-0" id="{{id}}">{{content}}</div></div>',
            // Container for error items.
            'errorList' => '<ul>{{content}}</ul>',
            // Error item wrapper.
            'errorItem' => '<li>{{text}}</li>',
            // File input used by file().
            'file' => '<input type="file" name="{{name}}"{{attrs}}>',
            // Fieldset element used by allControls().
            'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Open tag used by create().
            'formStart' => '<form{{attrs}}>',
            // Close tag used by end().
            'formEnd' => '</form>',
            // General grouping container for control(). Defines input/label ordering.
            'formGroup' => '{{label}}{{input}}',
            // Wrapper content used to hide other content.
            'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
            // Generic input element.
            'input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
            // Submit input element.
            'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
            // Container element used by control().
            'inputContainer' => '<div class="row {{type}}{{required}}">{{content}}</div>',
            // Container element used by control() when a field has an error.
            'inputContainerError' => '<div class="row {{type}}{{required}}">{{content}}{{error}}</div>',
            // Label element when inputs are not nested inside the label.
            'label' => '<div class="col-sm-3"><label{{attrs}}>{{text}}</label></div>',
            // Label element used for radio and multi-checkbox inputs.
            'nestingLabel' => '<div>{{hidden}}{{input}}<label{{attrs}}>{{text}}</label></div>',
            // Legends created by allControls()
            'legend' => '<legend>{{text}}</legend>',
            // Multi-Checkbox input set title element.
            'multicheckboxTitle' => '<legend>{{text}}</legend>',
            // Multi-Checkbox wrapping container.
            'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Option element used in select pickers.
            'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
            // Option group element used in select pickers.
            'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            // Select element,
            'select' => '<div class="col-sm-9"><select name="{{name}}"{{attrs}}>{{content}}</select></div>',
            // Multi-select element,
            'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
            // Radio input element,
            'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Wrapping container for radio input/label,
            'radioWrapper' => '{{label}}',
            // Textarea input element,
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            // Container for submit buttons.
            'submitContainer' => '<div class="submit">{{content}}</div>',
            // Confirm javascript template for postLink()
            'confirmJs' => '{{confirm}}',
            // selected class
            'selectedClass' => 'selected',
            'radioFormGroup' => '{{label}}<div class="col-sm-9">{{input}}</div>',
        ];
    }

    /**
     * @return array
     */
    public static function getVerticalFormTemplates()
    {
        return  [
            // Used for button elements in button().
            'button' => '<button{{attrs}}>{{text}}</button>',
            // Used for checkboxes in checkbox() and multiCheckbox().
            'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Input group wrapper for checkboxes created via control().
            'checkboxFormGroup' => '{{label}}',
            // Wrapper container for checkboxes.
            'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
            // Error message wrapper elements.
            'error' => '<div></div><div><input class="is-invalid" hidden><div class="error-message invalid-feedback mt-0" id="{{id}}">{{content}}</div></div>',
            // Container for error items.
            'errorList' => '<ul>{{content}}</ul>',
            // Error item wrapper.
            'errorItem' => '<li>{{text}}</li>',
            // File input used by file().
            'file' => '<input type="file" name="{{name}}"{{attrs}}>',
            // Fieldset element used by allControls().
            'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Open tag used by create().
            'formStart' => '<form{{attrs}}>',
            // Close tag used by end().
            'formEnd' => '</form>',
            // General grouping container for control(). Defines input/label ordering.
            'formGroup' => '{{label}}{{input}}',
            // Wrapper content used to hide other content.
            'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
            // Generic input element.
            'input' => '<div><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
            // Submit input element.
            'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
            // Container element used by control().
            'inputContainer' => '<div class="row {{type}}{{required}}">{{content}}</div>',
            // Container element used by control() when a field has an error.
            'inputContainerError' => '<div class="row {{type}}{{required}}">{{content}}{{error}}</div>',
            // Label element when inputs are not nested inside the label.
            'label' => '<div><label{{attrs}}>{{text}}</label></div>',
            // Label element used for radio and multi-checkbox inputs.
            'nestingLabel' => '<div>{{hidden}}{{input}}<label{{attrs}}>{{text}}</label></div>',
            // Legends created by allControls()
            'legend' => '<legend>{{text}}</legend>',
            // Multi-Checkbox input set title element.
            'multicheckboxTitle' => '<legend>{{text}}</legend>',
            // Multi-Checkbox wrapping container.
            'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
            // Option element used in select pickers.
            'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
            // Option group element used in select pickers.
            'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            // Select element,
            'select' => '<div><select name="{{name}}"{{attrs}}>{{content}}</select></div>',
            // Multi-select element,
            'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
            // Radio input element,
            'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            // Wrapping container for radio input/label,
            'radioWrapper' => '{{label}}',
            // Textarea input element,
            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            // Container for submit buttons.
            'submitContainer' => '<div class="submit">{{content}}</div>',
            // Confirm javascript template for postLink()
            'confirmJs' => '{{confirm}}',
            // selected class
            'selectedClass' => 'selected',
            'radioFormGroup' => '{{label}}<div>{{input}}</div>',
        ];
    }
}
