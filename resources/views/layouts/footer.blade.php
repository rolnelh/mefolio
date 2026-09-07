<footer class="bg-white pt-20 pb-10 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col lg:flex-row justify-between items-start gap-12 pb-16">

            <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                <x-application-logo class="h-7 w-auto text-indigo-600" />
                <span class="text-xl font-bold text-slate-900 tracking-tight">Mefolio</span>
            </a>

            <nav class="flex flex-wrap gap-x-10 gap-y-4 text-sm font-bold text-slate-900">
                <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Projets</a>
                <a href="{{ route('creatifs.index') }}" class="hover:text-indigo-600 transition-colors">Talents</a>
                <a href="{{ route('missions.index') }}" class="hover:text-indigo-600 transition-colors">Missions</a>
                <a href="{{ route('blog') }}" class="hover:text-indigo-600 transition-colors">Blog</a>
                <a href="{{ route('vision') }}" class="hover:text-indigo-600 transition-colors">À propos</a>
            </nav>

            <a href="mailto:contact@mefolio.com"
                class="inline-flex items-center gap-2 text-sm font-bold text-slate-900 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                contact@mefolio.com
            </a>
        </div>

        <div class="pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="text-[13px] text-slate-400 font-medium">© {{ now()->year }} Mefolio. Tous droits réservés.</span>
            <div class="flex flex-wrap justify-center gap-6 text-[13px] text-slate-400 font-medium">
                <a href="{{ route('vision') }}" class="hover:text-slate-900 transition-colors">Notre vision</a>
                <a href="{{ route('hackathons.index') }}" class="hover:text-slate-900 transition-colors">Programmes</a>
                <a href="{{ route('classement.index') }}" class="hover:text-slate-900 transition-colors">Classement</a>
            </div>
        </div>

    </div>
</footer>
