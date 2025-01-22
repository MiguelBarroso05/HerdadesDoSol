<?php
$estates = \App\Models\Estate::all();
$entrydate = null;
$departuredate = null;
?>
@extends('layouts.app')
@section('content')
    <style>
        .selected {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
        }

        .range {
            background-color: #93c5fd;
        }

    </style>
    @include('layouts.navbars.guest.navbar')
    <main class="hs-d-flex hs-flex-grow-1 hs-mt-8 hs-px-9">
        <div class="hs-bg-gradient-danger hs-w-70">
            <div class="hs-bg-dark hs-w-100 hs-py-3 hs-d-inline-flex hs-justify-content-between hs-px-1">
                <div class="hs-w-25 ">
                    <!-- Select -->
                    <select
                        class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500
                         focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900
                          dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500
                           dark:focus:ring-neutral-600">
                        <option selected="">Select a Estate</option>
                        @foreach($estates as $estate)
                            <option value="{{$estate->id}}">{{$estate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- End Select -->
                <div class="hs-w-25">
                    <x-datetime-picker
                        value="{{$entrydate}}"
                        id="entry_date"
                        wire:model.live="model6"
                        placeholder="Appointment Date"
                        parse-format="DD-MM-YYYY"
                    />
                </div>
                <div class="hs-w-25">
                    <x-datetime-picker
                        value="{{$departuredate}}"
                        id="departure_date"
                        wire:model.live="model2"
                        placeholder="Appointment Date"
                        parse-format="DD-MM-YYYY"
                    />
                </div>
            </div>
            <div class="hs-bg-card hs-w-100 hs-h-100">
                <div id="calendar-container" class="calendar-container">
                    <div class="calendar-header flex justify-between items-center py-2">
                        <button id="prev-month" class="py-1 px-2 text-gray-800 bg-gray-200 rounded">←</button>
                        <div id="month-name" class="text-xl font-bold"></div>
                        <button id="next-month" class="py-1 px-2 text-gray-800 bg-gray-200 rounded">→</button>
                    </div>

                    <div class="calendar-grid grid grid-cols-7 gap-2">
                        <div class="day-name text-center font-bold">Dom</div>
                        <div class="day-name text-center font-bold">Seg</div>
                        <div class="day-name text-center font-bold">Ter</div>
                        <div class="day-name text-center font-bold">Qua</div>
                        <div class="day-name text-center font-bold">Qui</div>
                        <div class="day-name text-center font-bold">Sex</div>
                        <div class="day-name text-center font-bold">Sáb</div>
                    </div>

                    <div id="calendar" class="calendar-grid grid grid-cols-7 gap-2">
                        <!-- Os dias serão inseridos aqui -->
                    </div>

                    <button id="submit-dates"
                            class="py-2 px-4 bg-blue-600 text-white rounded mt-4 disabled:opacity-50 disabled:pointer-events-none"
                            disabled>Enviar Datas
                    </button>
                </div>


            </div>
        </div>
        <div class="hs-bg-gradient-warning hs-w-30 hs-p-3">
            <div class="hs-d-inline-flex">
                <div class="hs-w-45">
                    <x-number label="Group size" value="0"/>
                </div>
                <div class="hs-w-45">
                    <x-number label="Children" value="0"/>
                </div>
            </div>
            <div class="relative">
                <select data-hs-select='{
                                          "placeholder": "Select option...",
                                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                          "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-neutral-900 dark:border-neutral-700",
                                          "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                                        }'>
                    <option value="">Choose</option>
                    <option>Name</option>
                    <option>Email address</option>
                    <option>Description</option>
                    <option>User ID</option>
                </select>

                <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5"></path>
                        <path d="m7 9 5-5 5 5"></path>
                    </svg>
                </div>
            </div>

            <x-multiple-input :object="$estates" :placeholder="'Activities'"/>
        </div>


    </main>
    @push('js')
        <script>
            const calendar = document.getElementById("calendar");
            const submitButton = document.getElementById("submit-dates");
            const monthName = document.getElementById("month-name");
            const prevMonthBtn = document.getElementById("prev-month");
            const nextMonthBtn = document.getElementById("next-month");

            const entryDatePicker = document.getElementById("entry_date"); // Componente para a data inicial
            const departureDatePicker = document.getElementById("departure_date"); // Componente para a data final


            let currentMonth = new Date().getMonth(); // Mês atual
            let currentYear = new Date().getFullYear(); // Ano atual
            let startDate = null;
            let endDate = null;

            // Função para obter os dias do mês atual
            function getDaysInMonth(month, year) {
                return new Date(year, month + 1, 0).getDate();
            }

            // Função para obter o dia da semana do primeiro dia do mês
            function getFirstDayOfMonth(month, year) {
                return new Date(year, month, 1).getDay();
            }

            // Função para gerar o nome do mês e os dias
            function updateCalendar() {
                // Atualiza o nome do mês
                monthName.textContent = new Date(currentYear, currentMonth).toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });

                // Limpa o calendário anterior
                calendar.innerHTML = "";

                // Número de dias do mês
                const daysInMonth = getDaysInMonth(currentMonth, currentYear);

                // Obtém o primeiro dia da semana do mês
                const firstDayOfMonth = getFirstDayOfMonth(currentMonth, currentYear);

                // Obtém o último dia do mês anterior
                const prevMonthDays = getDaysInMonth(currentMonth - 1 < 0 ? 11 : currentMonth - 1, currentYear);

                // Preencher o calendário com os dias
                let dayCount = 1;

                // Preenche os dias do mês anterior
                for (let i = 0; i < firstDayOfMonth; i++) {
                    const button = document.createElement("button");
                    button.textContent = prevMonthDays - (firstDayOfMonth - 1 - i);
                    button.className = "day m-1 p-2 border rounded text-gray-400 cursor-pointer";
                    button.disabled = true;
                    button.dataset.month = currentMonth - 1 < 0 ? 11 : currentMonth - 1; // Mês anterior
                    button.dataset.year = currentMonth - 1 < 0 ? currentYear - 1 : currentYear; // Ano anterior, se for Janeiro
                    calendar.appendChild(button);
                }

                // Preenche os dias do mês atual
                for (let i = dayCount; i <= daysInMonth; i++) {
                    const button = document.createElement("button");
                    button.textContent = i;
                    button.className = "day m-1 p-2 border rounded text-gray-800 hover:bg-gray-200";
                    button.dataset.day = i;
                    button.dataset.month = currentMonth;
                    button.dataset.year = currentYear;

                    // Desabilitar os dias anteriores à data atual
                    const today = new Date();
                    const currentDay = new Date(currentYear, currentMonth, i);
                    if (currentDay < today) {
                        // Torna os dias anteriores mais acinzentados e não clicáveis
                        button.classList.add("text-gray-400", "cursor-not-allowed");
                        button.classList.remove("text-gray-800");
                        button.disabled = true;
                    }

                    calendar.appendChild(button);
                    dayCount++;
                }

                // Preenche os dias do próximo mês, se necessário, mas agora apenas 35 dias no total
                const remainingDays = 35 - (firstDayOfMonth + daysInMonth); // Total de dias no calendário (5 linhas * 7 colunas)
                for (let i = 1; i <= remainingDays; i++) {
                    const button = document.createElement("button");
                    button.textContent = i;
                    button.className = "day m-1 p-2 border rounded text-gray-400 cursor-pointer";
                    button.disabled = true;
                    button.dataset.month = currentMonth + 1 > 11 ? 0 : currentMonth + 1; // Próximo mês
                    button.dataset.year = currentMonth + 1 > 11 ? currentYear + 1 : currentYear; // Ano seguinte, se for Dezembro
                    calendar.appendChild(button);
                }

                // Após a renderização, destaca o intervalo selecionado
                highlightRange();
            }

            function isDateInRange(month, day, year) {
                if (!startDate || !endDate) return false;

                const start = new Date(startDate.year, startDate.month, startDate.day);
                const end = new Date(endDate.year, endDate.month, endDate.day);
                const current = new Date(year, month, day);

                return current >= start && current <= end;
            }

            // Função para destacar o intervalo de datas
            function highlightRange() {
                const days = document.querySelectorAll(".day");
                days.forEach((button) => {
                    const day = parseInt(button.dataset.day);
                    const month = parseInt(button.dataset.month);
                    const year = parseInt(button.dataset.year);

                    // Verifica se o botão corresponde ao startDate
                    if (startDate && month === startDate.month && day === startDate.day && year === startDate.year) {
                        button.classList.add("selected");
                    }
                    // Verifica se o botão corresponde ao endDate
                    else if (endDate && month === endDate.month && day === endDate.day && year === endDate.year) {
                        button.classList.add("selected");
                    }
                    // Verifica se o botão está dentro do intervalo (range), considerando a transição de mês
                    else if (isDateInRange(month, day, year)) {
                        button.classList.add("range");
                    } else {
                        // Remove a classe 'range' se o dia não estiver no intervalo
                        button.classList.remove("range");
                    }
                });
            }

            // Função para limpar a seleção
            function clearSelection() {
                const days = document.querySelectorAll(".day");
                days.forEach((button) => {
                    button.classList.remove("selected", "range");
                });
            }

            // Lida com a seleção de datas
            function handleDateSelection(event) {
                const day = parseInt(event.target.dataset.day);
                const month = parseInt(event.target.dataset.month);
                const year = parseInt(event.target.dataset.year);

                if (!startDate || (startDate && endDate)) {
                    // Reiniciar a seleção
                    startDate = {day, month, year};
                    endDate = null;
                    clearSelection();
                    event.target.classList.add("selected");
                } else if (
                    (year === startDate.year && month === startDate.month && day > startDate.day) ||
                    (year > startDate.year) ||
                    (year === startDate.year && month > startDate.month)
                ) {
                    // Seleção do fim do intervalo
                    endDate = {day, month, year};
                    highlightRange();
                } else {
                    alert("A data final deve ser maior que a inicial.");
                }

                // Ativar/desativar o botão de envio
                submitButton.disabled = !(startDate && endDate);
            }

            // Enviar o intervalo de datas
            submitButton.addEventListener("click", () => {
                if (startDate && endDate) {
                    const payload = {
                        startDate: `${startDate.day} ${new Date(currentYear, startDate.month).toLocaleString('default', {month: 'long'})} ${startDate.year}`,
                        endDate: `${endDate.day} ${new Date(currentYear, endDate.month).toLocaleString('default', {month: 'long'})} ${endDate.year}`,
                    };

                    console.log("Enviando intervalo de datas:", payload);

                    // Exemplo de envio com fetch
                    fetch("/api/send-dates", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(payload),
                    })
                        .then((response) => response.json())
                        .then((data) => console.log("Resposta do servidor:", data))
                        .catch((error) => console.error("Erro ao enviar as datas:", error));
                }
            });

            // Navegar para o mês anterior
            prevMonthBtn.addEventListener("click", () => {
                if (currentMonth === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                updateCalendar();
            });

            // Navegar para o próximo mês
            nextMonthBtn.addEventListener("click", () => {
                if (currentMonth === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                updateCalendar();
            });

            // Adicionar evento de clique aos botões de dia
            calendar.addEventListener("click", (event) => {
                if (event.target.classList.contains("day")) {
                    handleDateSelection(event);
                }
            });

            // Inicializar o calendário
            updateCalendar();
        </script>
    @endpush
@endsection
