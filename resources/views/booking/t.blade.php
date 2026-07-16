@extends('layouts.admin', ['active' => 'users']) @section('title', 'Users') @section('content')
  @php $svg = fn($path) => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>'; @endphp
  @if (session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg p-3"> {{ session('success') }}
  </div> @endif <div class="flex items-start justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-slate-900"> Users </h1>
      <p class="text-sm text-slate-400 mt-1"> Welcome back, Admin. Here's what's happening today. </p>
    </div>
    <div class="flex items-center gap-3"> <span
        class="text-sm text-slate-500 bg-white border border-slate-200 rounded-lg px-3 py-1.5">
        {{ now()->format('F j, Y') }} </span> <button type="button" id="openCreateUserModal"
        class="bg-blue-600 hover:bg-blue-700 w-25 text-[10px] text-white px-4 py-2 rounded-lg"> + Add User </button>
    </div>
  </div>
  <form method="GET" action="{{ route('admin.users') }}" id="searchForm">
    <div class="flex items-center gap-3 my-4">
      <div class="flex-1 flex items-center rounded-xl border border-gray-300 px-4 py-3"> <svg
          xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2" class="text-gray-400">
          <circle cx="11" cy="11" r="8" />
          <path d="m21 21-4.35-4.35" />
        </svg> <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search user..." id="searchInput"
          class="ml-2 w-full bg-none outline-none"> </div>
    </div>
  </form>
  <div class="bg-white rounded-xl border border-slate-200">
    <table class="w-full text-sm">
      <thead>
        <tr class="border-b">
          <th class="p-4 text-left">Name</th>
          <th class="p-4 text-left">Email</th>
          <th class="p-4 text-left">Created</th>
        </tr>
      </thead>
      <tbody> @foreach($users as $user) <tr class="border-b hover:bg-slate-50">
        <td class="p-4"> {{ $user->first_name }} {{ $user->last_name }} </td>
        <td class="p-4 text-slate-500"> {{ $user->email }} </td>
        <td class="p-4 text-slate-400"> {{ $user->created_at->format('M d, Y') }} </td>
      </tr> @endforeach </tbody>
    </table>
  </div> {{ $users->links() }} <!-- Create User Modal -->
  <div id="createUserModal" class="fixed inset-0 z-50 hidden"> <!-- Backdrop -->
    <div id="modalBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div> <!-- Modal -->
    <div class="relative z-10 flex items-center justify-center min-h-screen p-6">
      <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
          <div>
            <h2 class="text-xl font-semibold text-slate-900"> Create User </h2>
            <p class="text-sm text-slate-500 mt-1"> Add a new user to your system. </p>
          </div> <button type="button" id="closeCreateUserModal"
            class="w-10 h-10 rounded-lg hover:bg-slate-100 text-slate-500 transition"> ✕ </button>
        </div> <!-- Errors -->
        <div id="createUserErrors" class="hidden mx-6 mt-5 rounded-xl border border-red-200 bg-red-50 p-4">
          <ul id="createUserErrorList" class="text-sm text-red-700 space-y-1 list-disc list-inside"> </ul>
        </div> <!-- Form -->
        <form id="createUserForm" class="p-6 space-y-5"> @csrf <div class="grid grid-cols-2 gap-4">
            <div> <label class="block text-sm font-medium text-slate-700 mb-2"> First Name </label> <input type="text"
                name="first_name" placeholder="John"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
            </div>
            <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Last Name </label> <input type="text"
                name="last_name" placeholder="Doe"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
            </div>
          </div>
          <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Email </label> <input type="email"
              name="email" placeholder="john@example.com"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>
          <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Phone </label> <input type="text"
              name="phone" placeholder="+855 12 345 678"
              class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Password </label> <input type="password"
                name="password" placeholder="••••••••"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
            </div>
            <div> <label class="block text-sm font-medium text-slate-700 mb-2"> Confirm Password </label> <input
                type="password" name="password_confirmation" placeholder="••••••••"
                class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition">
            </div>
          </div> <!-- Footer -->
          <div class="flex justify-end gap-3 pt-3 border-t border-slate-200"> <button type="button" id="cancelCreateUser"
              class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition"> Cancel
            </button> <button type="submit"
              class="px-6 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition">
              Create User </button> </div>
        </form>
      </div>
    </div>
  </div>
  <script> // ----- Search ----- const searchInput = document.getElementById('searchInput'); const searchForm = document.getElementById('searchForm'); let timer; searchInput.addEventListener('input', function () { clearTimeout(timer); timer = setTimeout(() => { searchForm.submit(); }, 500); }); // ----- Create User Modal ----- const modal = document.getElementById('createUserModal'); const openBtn = document.getElementById('openCreateUserModal'); const closeBtn = document.getElementById('closeCreateUserModal'); const cancelBtn = document.getElementById('cancelCreateUser'); const backdrop = document.getElementById('modalBackdrop'); const form = document.getElementById('createUserForm'); const errorsBox = document.getElementById('createUserErrors'); const errorList = document.getElementById('createUserErrorList'); function openModal() { modal.classList.remove('hidden'); } function closeModal() { modal.classList.add('hidden'); form.reset(); errorsBox.classList.add('hidden'); errorList.innerHTML = ''; } openBtn.addEventListener('click', openModal); closeBtn.addEventListener('click', closeModal); cancelBtn.addEventListener('click', closeModal); backdrop.addEventListener('click', closeModal); form.addEventListener('submit', function (e) { e.preventDefault(); const formData = new FormData(form); fetch('{{ route('admin.users.store') }}', { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: formData }) .then(async (response) => { if (response.status === 422) { const data = await response.json(); errorList.innerHTML = ''; Object.values(data.errors).flat().forEach(msg => { const li = document.createElement('li'); li.textContent = msg; errorList.appendChild(li); }); errorsBox.classList.remove('hidden'); return; } if (!response.ok) { throw new Error('Something went wrong.'); } window.location.reload(); }) .catch(err => { errorList.innerHTML = ''; const li = document.createElement('li'); li.textContent = err.message; errorList.appendChild(li); errorsBox.classList.remove('hidden'); }); }); </script>
@endsection can we seperate file or keep the whole?