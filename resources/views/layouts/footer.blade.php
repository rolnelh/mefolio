<footer class="bg-slate-50 pt-16 pb-10 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white border border-gray-100 rounded-[2rem] shadow-sm shadow-gray-900/[0.02] p-8 sm:p-12">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 pb-10">

                {{-- Logo, tagline, newsletter --}}
                <div class="lg:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="h-7 w-auto text-indigo-600" />
                        <span class="text-xl font-bold text-slate-900 tracking-tight">Mefolio</span>
                    </a>
                    <p class="text-sm text-slate-500 leading-relaxed mt-4 max-w-xs">
                        La plateforme portfolio et marketplace des créatifs africains : designers, développeurs,
                        photographes, vidéastes.
                    </p>

                    <form method="POST" action="{{ route('newsletter.store') }}" class="mt-6 max-w-xs">
                        @csrf
                        <input type="hidden" name="source" value="footer">
                        <label for="footer-newsletter-email" class="text-xs font-bold text-slate-900 uppercase tracking-wider">
                            Restez informé
                        </label>
                        <div class="mt-2 flex items-center gap-1.5 bg-slate-50 border border-gray-200 rounded-full p-1.5">
                            <input id="footer-newsletter-email" type="email" name="email" required placeholder="Votre email"
                                class="flex-1 min-w-0 border-0 bg-transparent text-sm placeholder:text-slate-400 focus:ring-0">
                            <button type="submit"
                                class="flex-shrink-0 bg-slate-900 hover:bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-full transition-colors">
                                S'abonner
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Produit --}}
                <div class="lg:col-span-2 lg:col-start-6">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Produit</h3>
                    <ul class="space-y-3 text-sm font-semibold text-slate-600">
                        <li><a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Projets</a></li>
                        <li><a href="{{ route('creatifs.index') }}" class="hover:text-indigo-600 transition-colors">Talents</a></li>
                        <li><a href="{{ route('missions.index') }}" class="hover:text-indigo-600 transition-colors">Missions</a></li>
                        <li><a href="{{ route('challenges.index') }}" class="hover:text-indigo-600 transition-colors">Challenges</a></li>
                    </ul>
                </div>

                {{-- Communauté --}}
                <div class="lg:col-span-2">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Communauté</h3>
                    <ul class="space-y-3 text-sm font-semibold text-slate-600">
                        <li><a href="{{ route('classement.index') }}" class="hover:text-indigo-600 transition-colors">Classement</a></li>
                        <li><a href="{{ route('hackathons.index') }}" class="hover:text-indigo-600 transition-colors">Programmes</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-indigo-600 transition-colors">Blog</a></li>
                    </ul>
                </div>

                {{-- Ressources --}}
                <div class="lg:col-span-2">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Ressources</h3>
                    <ul class="space-y-3 text-sm font-semibold text-slate-600">
                        <li>
                            <a href="mailto:contact@mefolio.com" class="hover:text-indigo-600 transition-colors">
                                contact@mefolio.com
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-3">
                <span class="text-[13px] text-slate-400 font-medium">© {{ now()->year }} Mefolio. Tous droits réservés.</span>
                <span class="text-[13px] text-slate-400 font-medium">Fait avec soin par l'équipe Mefolio</span>
            </div>

        </div>
    </div>
</footer>
