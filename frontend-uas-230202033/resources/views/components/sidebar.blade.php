<div class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white shadow-lg z-50">
    <!-- Header -->
    <div class="p-5 h-16 border-b border-gray-700">
        <h1 class="text-2xl font-bold font-[Sansation] tracking-wide">SIMPANSE</h1>
    </div>

    <!-- Nav Links -->
    <nav class="flex flex-col py-4">
        <a href="/"
           class="flex items-center px-6 py-3 transition-all duration-300 hover:bg-gray-700 hover:pl-8 group">
            <i class="bi bi-speedometer2 mr-2"></i>
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <a href="/buku"
           class="flex items-center px-6 py-3 transition-all duration-300 hover:bg-gray-700 hover:pl-8 group">
            <i class="bi bi-person-lines-fill mr-2"></i>
            <span class="text-sm font-medium">Data Buku</span>
        </a>

        <a href="/peminjaman"
           class="flex items-center px-6 py-3 transition-all duration-300 hover:bg-gray-700 hover:pl-8 group">
            <i class="bi bi-person-lines-fill mr-2"></i>
            <span class="text-sm font-medium">Data Peminjaman</span>
        </a>

        <a href="/logout"
           class="flex items-center px-6 py-3 mt-auto transition-all duration-300 hover:bg-red-600 hover:pl-8 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-gray-400 group-hover:text-white"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            <span class="text-sm font-medium">Logout</span>
        </a>
    </nav>
</div>
