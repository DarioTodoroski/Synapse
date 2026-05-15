@extends('layouts.app')

@section('content')

<!-- 1 -->
<div class="flex pt-14 font-sans font-light flex-col justify-center items-center">
    <img src="{{ asset('img/elipse1.png') }}" class="absolute top-33 left-34 w-[271px] h-[271px]"/>
    <img src="{{ asset('img/elipse2.png') }}" class="absolute bottom-33 right-38 w-[271px] h-[271px]"/>
    <p class="text-[14px] text-[#00786F] bg-[#F0FDFA] px-5 py-2 border-[#CBFBF1] border-2 rounded-full">✦ Нудиме целосни, стратешки и практични HR решенија на едно место</p>
    <div class="pt-5 flex flex-col -space-y-5 ">
        <p class="text-[67px] text-center px-20 font-extrabold text-[#101828]">Им помагаме на</p>
        <p class="text-[67px] text-center px-20 font-extrabold text-[#101828]">организациите да растат</p>
        <p class="text-[67px] text-center px-20 font-extrabold bg-gradient-to-r from-[#5B52A3] to-[#7AB5A8] bg-clip-text text-transparent">преку луѓето </p>
    </div> 
    <p class="pt-5 text-center text-[20px] text-[#4A5565]">Ги поддржуваме компаниите да изградат силни тимови, ефективно лидерство и <br/>HR процеси што носат долгорочни резултати.</p>
    <div class="flex gap-5 pt-12">
        <a class="bg-[#5B52A3] rounded-xl px-9 text-white py-2">Контактирајте нѐ →</a>
        <a class="border-2 bg-white border-[#D1D5DC] rounded-xl px-4 py-2">Пребарајте услуги</a>
    </div>


</div>

<!-- 2 -->
<div class="flex justify-end font-sans items-center px-20 pt-20">
    <div class="w-1/3 space-y-16 flex flex-col items-center mt-4">
        <div class="flex flex-col w-[333px] pt-1 justify-end items-start">
            <p class="text-[14px] font-light text-[#5B52A3]">НАШИ УСЛУГИ</p>
            <p class="text-[#101828] font-bold text-[38px]">Стратегиски HR</p>
            <p class="text-[#4A5565] font-light text-[20px] pt-[23px]">Ги поврзуваме бизнис целите со HR практиките за создавање усогласени, стабилни и успешни тимови.</p>
        </div>
        <div class="w-[360px] h-[280px] mt-7 flex flex-col gap-4 justify-between shadow-md shadow-[#5B52A34D] bg-white p-[36px] rounded-3xl">
            <p class="text-[20px] font-semibold">Развој на вработени <br/>и кариера</p>
            <p class="text-[15px] font-light">Развиваме лидери и тимови преку практични програми, обуки и алатки што создаваат реален импакт.</p>
            <p class="text-[14px] font-semibold">Прочитај повеќе →</p>
        </div>
    </div>
    <div class="w-1/3 space-y-13 flex flex-col items-center">
        <div class="w-[360px] h-[280px] flex flex-col gap-4 justify-between shadow-md shadow-[#5B52A34D] bg-white p-[36px] rounded-3xl">
            <p class="text-[20px] font-semibold">Развој на вработени <br/>и кариера</p>
            <p class="text-[15px] font-light">Развиваме лидери и тимови преку практични програми, обуки и алатки што создаваат реален импакт.</p>
            <p class="text-[14px] font-semibold">Прочитај повеќе →</p>
        </div>
        <div class="w-[360px] h-[280px] flex flex-col gap-4 justify-between shadow-md shadow-[#5B52A34D] bg-white p-[36px] rounded-3xl">
            <p class="text-[20px] font-semibold">Развој на вработени <br/>и кариера</p>
            <p class="text-[15px] font-light">Развиваме лидери и тимови преку практични програми, обуки и алатки што создаваат реален импакт.</p>
            <p class="text-[14px] font-semibold">Прочитај повеќе →</p>
        </div>
    </div>
    <div class="w-1/3 space-y-13 flex flex-col items-center">
        <div class="w-[360px] h-[280px] flex flex-col gap-4 justify-between shadow-md shadow-[#5B52A34D] bg-white p-[36px] rounded-3xl">
            <p class="text-[20px] font-semibold">Развој на вработени <br/>и кариера</p>
            <p class="text-[15px] font-light">Развиваме лидери и тимови преку практични програми, обуки и алатки што создаваат реален импакт.</p>
            <p class="text-[14px] font-semibold">Прочитај повеќе →</p>
        </div>
        <div class="w-[360px] h-[280px] flex flex-col gap-4 justify-between shadow-md shadow-[#5B52A34D] bg-white p-[36px] rounded-3xl">
            <p class="text-[20px] font-semibold">Развој на вработени <br/>и кариера</p>
            <p class="text-[15px] font-light">Развиваме лидери и тимови преку практични програми, обуки и алатки што создаваат реален импакт.</p>
            <p class="text-[14px] font-semibold">Прочитај повеќе →</p>
        </div>
    </div>
</div>

<!-- 3 -->
<div class="flex flex-col font-sans justify-center items-center pt-24">
    <p class="font-light text-[16px] text-[#5B52A3]">ДОЗНАЈ ПОВЕЌЕ ЗА НАС</p>
    <p class="text-[48px] font-bold ">Зошто SynapseHR?</p>
    <div class="flex space-x-8 pt-7">
        <div class="w-[350.328125px] h-[300px] flex flex-col  justify-between shadow-md shadow-[#5B52A34D] bg-white py-[43px] px-[36px] rounded-2xl">
            <div class="w-14 h-14 flex items-center justify-center bg-gray-200 rounded-full">
                <i class="fa-solid fa-magnifying-glass text-gray-700"></i>
            </div>            
            <p class="text-[20px] pt-3 font-semibold">Практичен пристап</p>
            <p class="text-[15px] pt-6 font-light">Нудиме решенија што можат веднаш да се применат во секојдневното работење.</p>
        </div>
        <div class="w-[350.328125px] h-[300px] flex flex-col  justify-between shadow-md shadow-[#5B52A34D] bg-white py-[43px] px-[36px] rounded-2xl">
            <div class="w-14 h-14 flex items-center justify-center bg-gray-200 rounded-full">
                <i class="fa-solid fa-magnifying-glass text-gray-700"></i>
            </div>            
            <p class="text-[20px] pt-3 font-semibold">Практичен пристап</p>
            <p class="text-[15px] pt-6 font-light">Нудиме решенија што можат веднаш да се применат во секојдневното работење.</p>
        </div>
        <div class="w-[350.328125px] h-[300px] flex flex-col  justify-between shadow-md shadow-[#5B52A34D] bg-white py-[43px] px-[36px] rounded-2xl">
            <div class="w-14 h-14 flex items-center justify-center bg-gray-200 rounded-full">
                <i class="fa-solid fa-magnifying-glass text-gray-700"></i>
            </div>            
            <p class="text-[20px] pt-3 font-semibold">Практичен пристап</p>
            <p class="text-[15px] pt-6 font-light">Нудиме решенија што можат веднаш да се применат во секојдневното работење.</p>
        </div>
    </div>
</div>
<div class="px-12 pt-14">
    <div class="px-12 py-11 bg-gradient-to-r font-sans font-light from-[#5B52A3] to-[#7AB5A8] text-white p-6 rounded-3xl flex flex-col gap-2">
        <div class="absolute right-35  w-[64px] h-[64px]  flex items-center justify-center bg-[#FFFFFF33] rounded-full">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
        </div>  
        <p class="text-[30px]">Компании од различни индустрии нѝ веруваат</p>
        <p class="text-[16px] w-[90%]">кога треба да изградат јасна структура, функционални процеси и организациска култура што поддржува стабилен и одржлив раст, без разлика дали се работи за конкретен предизвик или поширока трансформација, ние ја избираме и вклучуваме најсоодветната експертиза од нашиот тим и мрежа на партнери.</p>
    </div>
</div>



@endsection