<?= $this->extend('layouts/main') ?>

<?= $this->section('main') ?>
<?= $this->include('components/navbar') ?>
<!-- form create -->

<?= $this->include('components/formCreate') ?>
<!-- <h1 class="text-6xl pt-44 text-primary">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde id dolores, ratione officia officiis ex veritatis. Facere, voluptatem? Debitis non sint quam deleniti ducimus. Praesentium exercitationem itaque dolorem labore consequatur tenetur ratione omnis, odio nihil nam voluptatem quibusdam eveniet animi quo numquam rerum iure?</h1> -->
<div class="min-h-screen max-w-[740px] dark:text-white pt-32 mx-auto">
    <!-- alert -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="max-w-full  min-h-screen dark:bg-black/50 bg-slate-700/40 w-full z-[99999] left-0 fixed top-16" id="message">
            <div class="alert alert-warning shadow-lg max-w-[740px] mt-8 mx-auto relative">
                <div class="0 w-[80%]">
                    <div class="flex  flex-col">

                        <span>
                            <?= session()->getFlashdata('message') ?>
                        </span>
                    </div>

                </div>
                <div class="absolute top-2 right-2">
                    <button onclick="myFunction()" class="bg-slate-700 p-2  text-white rounded-full">
                        <i data-feather="x"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if ($posts['posts']) : ?>
        <div class="w-full lg:px-0 px-6">
            <?php foreach ($posts['posts'] as $p) : ?>
                <div class="my-6">

                    <a href="/detail/<?= $p->postId ?>">
                        <h1 class="text-3xl font-semibold mb-3 "><?= $p->title ?>
                        </h1>
                    </a>
                    <div class="flex lg:flex-row flex-col mb-3">
                        <div class="lg:w-[70%] w-full lg:pr-4">
                            <p class="text-slate-600 break-words dark:text-slate-400"><?= substr($p->body, 0, 350) ?>...<em class="hover:cursor-pointer hover:underline text-primary "><a href="/detail/<?= $p->postId ?>">Read more</a></em>
                            </p>
                        </div>
                        <div class="w-full h-60 lg:mt-0 mt-4 lg:max-w-[30%] lg:max-h-36">
                            <img src="/img/<?= $p->image ?>" class="inline-flex w-full h-full object-contain" alt="">
                        </div>
                    </div>
                    <div class="w-full mt-5 flex justify-between lg:flex-row flex-col">
                        <div>

                            <a href="/category/<?= $p->category_id ?>" class="max-w-20 text-white lg:mt-4 mt-5 hover:bg-indigo-400 transition-all duration-300 bg-indigo-500 p-2 rounded-md"># <?= $p->name_category ?></a>
                        </div>
                        <div class="lg:mt-5 mt-4">
                            <p class="dark:text-slate-300 text-slate-500">Post By : <?= $p->name_user  ?></p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="border border-dotted border-black dark:border-white"></div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- topis section -->
        <div class="px-6 lg:px-0">
            <?= $this->include('components/topics') ?>
        </div>
        <!--  -->
        <div class="w-full py-16 my-12 mx-auto">
            <div class="flex justify-around flex-row">
                <?= $posts[0]->links('posts', 'homePaginate') ?>
            </div>
        </div>
    <?php else : ?>
        <h1 class="text-3xl py-32 text-black dark:text-white text-center">Post Not Found</h1>

    <?php endif ?>
</div>
<?= $this->endSection() ?>