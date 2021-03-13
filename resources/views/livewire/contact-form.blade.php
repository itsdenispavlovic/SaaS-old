<form class="contact-form">
    <div class="form-group">
        <label>How can I help you?</label>
        <select wire:model.lazy="contact_type_id" class="form-control has-style1 mb-0 " id="service">
            <option value="">Select</option>
            @foreach($contactTypes as $contactType)
                <option value="{{ $contactType->id }}">{{ $contactType->name }}</option>
            @endforeach
        </select>
        @error('contact_type_id') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Your Name</label>
        <input wire:model.lazy="name" placeholder="Your Name" class="form-control has-style1 mb-0" id="how"
               type="text">
        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label>Email</label>
        <input wire:model.lazy="email" placeholder="example@domain.com" class="form-control has-style1 mb-0" id="how"
               type="text">
        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <label>Tell me more about your project</label>
    <textarea wire:model.lazy="content" class="textarea has-style1 mb-0" placeholder="How can we help?"></textarea>
    @error('content') <span class="error text-danger">{{ $message }}</span> @enderror
    <div class="form-group mt-2">
        <button class="btn btn-primary btn-round" type="button" wire:click.prevent="submit">
            <span> Send me → </span>
        </button>
    </div>
</form>
