<nav class="flex items-center justify-between flex-wrap shadow-md px-6 pt-3 pb-4">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <a href="<?= $this->Url->build('/') ?>" class="w-16">
            <?= $this->Html->image('v1.svg', ['alt' => 'Huerto urbano virtua']) ?>
        </a>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="lg:flex-grow">
            <?= $this->element('navbar-items') ?>
        </div>
        <form class="w-full max-w-sm">
            <div class="flex items-center border-b border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="¿Qué estás buscando?" aria-label="¿Qué estás buscando?">
                <button class="flex-shrink-0 bg-green-500 hover:bg-green-900 text-sm text-white py-1 px-2 rounded" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</nav>