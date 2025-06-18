<div class="w-full justify-between h-16 pr-72 bg-gray-800 px-6 flex items-center text-white fixed top-0 left-64">
    <div class="text-xl">Dashboard Admin</div>
    
    <form action="" method="POST" class="flex">
        @csrf
        <button type="submit" class="flex justify-center items-center gap-2 text-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-sm cursor-pointer">
            <i class="bi bi-box-arrow-left"></i>
            Sign Out
        </button>
    </form>
</div>
