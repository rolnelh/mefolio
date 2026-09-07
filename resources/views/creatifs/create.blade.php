<x-app-layout>
    <div class="min-h-screen bg-white py-16 px-6">
        <div class="max-w-3xl mx-auto">

            <!-- HEADER -->
            <div class="pb-12 mb-12 border-b border-gray-200">
                <h1 class="text-4xl font-semibold tracking-tight text-gray-900">
                    Créez votre profil créatif
                </h1>
                <p class="text-gray-500 mt-3 max-w-xl">
                    Rejoignez la communauté et exposez votre talent au monde africain et international.
                </p>
            </div>

            <form action="{{ route('creatifs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-14">
                @csrf

                <!-- IDENTITÉ VISUELLE -->
                <div class="space-y-8 border-b border-gray-200 pb-12">
                    <h2 class="text-sm font-medium uppercase tracking-widest text-gray-400">
                        Identité visuelle
                    </h2>

                    <!-- Bannière -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Bannière de couverture
                        </label>

                        <div class="relative h-40 border border-gray-300 bg-white overflow-hidden cursor-pointer"
                            x-data="{ preview: null }">

                            <template x-if="preview">
                                <img :src="preview" class="absolute inset-0 w-full h-full object-cover">
                            </template>

                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 text-sm">
                                Cliquez pour ajouter une bannière
                                <span class="text-xs mt-1">1200 × 400 px recommandé</span>
                            </div>

                            <input type="file" name="couverture" accept="image/*"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <!-- Avatar -->
                    <div class="flex items-center gap-6" x-data="{ preview: null }">
                        <div class="relative">
                            <div class="w-20 h-20 border border-gray-300 bg-gray-100 overflow-hidden">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                            </div>

                            <input type="file" name="photo" accept="image/*"
                                @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="mt-3 text-sm text-gray-500">
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-800">Photo de profil</p>
                            <p class="text-xs text-gray-400 mt-1">JPG ou PNG · Haute qualité</p>
                        </div>
                    </div>
                </div>

                <!-- INFORMATIONS -->
                <div class="space-y-8 border-b border-gray-200 pb-12">
                    <h2 class="text-sm font-medium uppercase tracking-widest text-gray-400">
                        Informations de base
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" name="prenom" required
                                class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="nom" required
                                class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Spécialité</label>
                            <input type="text" name="specialite" required placeholder="ex: Illustrateur UX"
                                class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Localisation</label>
                            <input type="text" name="localisation" required placeholder="Ville, Pays"
                                class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0">
                        </div>
                    </div>
                </div>

                <!-- BIO -->
                <div class="space-y-8 border-b border-gray-200 pb-12">
                    <h2 class="text-sm font-medium uppercase tracking-widest text-gray-400">
                        À propos
                    </h2>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Biographie</label>
                        <textarea name="bio" rows="4" placeholder="Décrivez votre univers créatif en quelques lignes..." required
                            class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Lien Portfolio / Site</label>
                        <input type="url" name="portfolio_url" placeholder="https://"
                            class="mt-2 w-full border border-gray-300 bg-white rounded-md focus:border-black focus:ring-0">
                    </div>

                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
                        <input type="checkbox" name="available_for_work" value="1" checked
                            class="rounded border-gray-300 text-black focus:ring-0">
                        Je suis disponible pour de nouvelles missions
                    </label>
                </div>

                <!-- BUTTON -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 border border-black text-black font-medium transition hover:bg-black hover:text-white">
                        Finaliser mon inscription
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-5">
                        Vous pourrez modifier ces informations à tout moment depuis votre tableau de bord.
                    </p>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
