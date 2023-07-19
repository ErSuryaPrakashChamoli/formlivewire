<div>
    <h1>User Registartion</h1>

    <form wire:submit.prevent="submit">

        <input type="text" name="name" wire:model="name" />
        @error('name') <span class="error">{{ $message }}</span> @enderror
        <br><br>
        <input type="text" name="email" wire:model="email" />
        @error('email') <span class="error">{{ $message }}</span> @enderror
        <br><br>

        <input type="password" name="password" wire:model="password" />
        @error('password') <span class="error">{{ $message }}</span> @enderror
        <br><br>

        <button type="submit">Register</button>

    </form>
</div>

<style>
         .error {
            color: red;
         }
</style>