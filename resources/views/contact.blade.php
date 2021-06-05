<x-app-layout>
    <x-slot name="title">
         - تماس با من
    </x-slot>
    
<main class="bg--white" style="margin-top: 9.5rem; margin-bottom: 0.75rem">
    <div class="container">
        <div class="card">
            <h1>تماس با من</h1>
            <div class="img">
                <img class="images" src="{{ asset('/images/about.jpg') }}" alt="">
            </div>
            <ul>
                <li>َشماره تماس : 09134430898</li>
                <li>linkedin : <a style="color: rgb(0, 174, 255)" href="https://www.linkedin.com/in/amirmahdi-abootalebi/">کلیک کنید</a></li>
                <li>github : <a style="color: rgb(0, 174, 255)" href="https://github.com/AmirmahdiAbtl">کلیک کنید</a></li>
            </ul>
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
       li{
           padding-bottom: 1rem;
       }
       
   </style>
</x-slot>
</x-app-layout>