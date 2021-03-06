<x-app-layout>
    <x-slot name="title">
         - درباره من
    </x-slot>
<main class="bg--white" style="margin-top: 9.5rem; margin-bottom: 0.75rem">
    <div class="container">
        <div class="card">
            <h1>درباره من</h1>
            <div class="img">
                <img class="images" src="{{ asset('/images/about.jpg') }}" alt="">
            </div>
            <h3>
                برنامه نویس Full-Stack 
            </h3>
            <p>
                 توسعه دهنده Laravel , React , Livewire
            </p>
            <p>
                دیگر توانایی ها git , Docker , Sass , SVG , REST full Api , ....
            </p>
            <p>
                برنامه نویس فول استک شرکت پازل از سال 99
            </p>
            </div>
        </div>
    </div>
</main>
<x-slot name="css">
   <style>
       .card{
           padding: 1rem;
           display: flex;
           justify-content: center;
           flex-direction: column;
           align-items: center;
       }
       .img{
           width: 15rem;
        }
        .images{
            width: 100%;
            border-radius: 50%;
            border: 0.5rem solid rgb(0, 137, 161);
       }
       p{
           padding-bottom: 0.5rem;
       }
       
   </style>
</x-slot>
</x-app-layout>