<?php

namespace App\Http\Livewire;

use App\Mail\NewContactMail;
use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $contactTypes = [];
    public $contact_type_id = null;
    public $name = '';
    public $email = '';
    public $content = '';

    public function mount()
    {
        $this->contactTypes = ContactType::where('active', true)->get();
    }

    protected $rules = [
        'contact_type_id' => 'required',
        'email' => 'required|email:filter',
        'name' => 'required|string|min:3',
        'content' => 'required|string|min:10'
    ];

    protected $validationAttributes = [
        'contact_type_id' => 'contact type'
    ];

    public function submit()
    {
        $this->validate();

        // verify if the content are the same
        if(Contact::where('contact_type_id', $this->contact_type_id)->where('name', $this->name)->where('email', $this->email)->where('content', $this->content)->exists())
        {
            $this->dispatchBrowserEvent('swal:modal-listener', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Sorry, but there is already an similar mail.'
            ]);

            return false;
        }

        $contactType = ContactType::find($this->contact_type_id);

        if(is_null($contactType))
        {
            $this->dispatchBrowserEvent('swal:modal-listener', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Sorry, an error has occurred.'
            ]);

            return false;
        }

        Contact::create([
            'contact_type_id' => $contactType->id,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content
        ]);

        $emailData = [
            'contact_type' => $contactType->name,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content
        ];

        // Message me
        Mail::to('pavlovicdenis@icloud.com')->send(new NewContactMail($emailData));

        // Empty the fields
        $this->contact_type_id = null;
        $this->name = '';
        $this->email = '';
        $this->content = '';

        // Show sweet alert
        $this->dispatchBrowserEvent('swal:modal-listener', [
            'type' => 'success',
            'title' => 'Succes',
            'text' => 'We will get back to you soon.'
        ]);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
