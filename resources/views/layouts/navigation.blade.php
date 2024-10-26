<nav class="relative bg-base-100 shadow-lg border-slate-500 min-h-16 flex items-center w-full">
    <div class="absolute bottom-0 w-full h-0.5 bg-slate-300 "></div>
    <div class="px-10 max-md:px-4 flex flex-row justify-between w-full">
        <a href="/" class=" text-2xl max-md:text-sm font-bold leading-relaxed  py-2 whitespace-nowrap">
            Wideskarangharjo.
        </a>
        <div class="flex flex-row items-center gap-2 max-md:text-xs ">
            <div class=" border shadow-md rounded-lg overflow-hidden">
                <a href="{{ route('profile.edit') }}"
                    class="flex flex-row items-center px-3 py-1   text-base-dark font-semibold bg-white fill-base-dark hover:bg-base-dark hover:text-white hover:fill-white">
                    <svg class="w-5 aspect-square" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                        viewBox="0 0 101 101" id="user">
                        <path
                            d="M50.4 54.5c10.1 0 18.2-8.2 18.2-18.2S60.5 18 50.4 18s-18.2 8.2-18.2 18.2 8.1 18.3 18.2 18.3zm0-31.7c7.4 0 13.4 6 13.4 13.4s-6 13.4-13.4 13.4S37 43.7 37 36.3s6-13.5 13.4-13.5zM18.8 83h63.4c1.3 0 2.4-1.1 2.4-2.4 0-12.6-10.3-22.9-22.9-22.9H39.3c-12.6 0-22.9 10.3-22.9 22.9 0 1.3 1.1 2.4 2.4 2.4zm20.5-20.5h22.4c9.2 0 16.7 6.8 17.9 15.7H21.4c1.2-8.9 8.7-15.7 17.9-15.7z">
                        </path>
                    </svg>
                    <p>Edit Profile</p>
                </a>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-left w-full bg-red-600 p-2 text-white font-semibold rounded-lg">Logout</button>
            </form>
        </div>
    </div>


</nav>
