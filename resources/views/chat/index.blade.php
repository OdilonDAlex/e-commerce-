@vite(['resources/css/admin/message.css', 'resources/js/admin/message.js'])

<x-admin-page-layout>
    <div class="users">

    <x-search-bar placeholder="Nom de la personne" value="Rechercher"/>

    @forelse($users as $user)
        <x-admin.user-l-i-template :user=$user/>
    @empty
    @endforelse
    </div>
    <x-message-container/>
</x-admin-page-layout>