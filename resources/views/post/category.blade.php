<?php 
    /** @var $posts Illuminate\Pagination\LengthAwarePaginator */    
?>

<x-app-layout :meta-title="$category->title" meta-description="Personal blog on non serious matter">
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        
        @foreach ($posts as $post)
            <x-post-item :post="$post" />
        @endforeach    
        
        <!-- Pagination -->
        {{$posts->onEachSide(1)->links()}}                
    </section>
    
    <x-sidebar />
</x-app-layout>
