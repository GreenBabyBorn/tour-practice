<template>
  <form class="flex gap-2 mx-auto flex-col md:flex-row w-full md:w-auto">
    <div class="text-left">
      <Combobox v-model="selectedFrom">
        <ComboboxLabel>Откуда</ComboboxLabel>
        <div class="relative mt-1">
          <div
            class="relative z-40 w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
            <ComboboxInput class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
              :displayValue="(person: any) => person.from" @change="queryFrom = $event.target.value" />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
              <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>
          </div>
          <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
            @after-leave="queryFrom = ''">
            <ComboboxOptions
              class="absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
              <div v-if="filteredFrom.length === 0 && queryFrom !== ''"
                class="relative cursor-default select-none py-2 px-4 text-gray-700">
                Ничего не найдено
              </div>

              <ComboboxOption v-for="person in filteredFrom" as="template" :key="person.id" :value="person"
                v-slot="{ selected, active }">
                <li class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{
                  'bg-green-600 text-white': active,
                  'text-gray-900': !active,
                }">
                  <span class="block truncate" :class="{
                    'font-medium': selected,
                    'font-normal': !selected,
                  }">
                    {{ person.from }}
                  </span>
                  <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{
                    'text-white': active,
                    'text-green-600': !active,
                  }">
                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </TransitionRoot>
        </div>
      </Combobox>
    </div>
    <div class="text-left">
      <Combobox v-model="selectedTo">
        <ComboboxLabel>Куда</ComboboxLabel>
        <div class="relative mt-1">
          <div
            class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm">
            <ComboboxInput class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
              :displayValue="(person: any) => person.to" @change="queryTo = $event.target.value" />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
              <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>
          </div>
          <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
            @after-leave="queryTo = ''">
            <ComboboxOptions
              class="absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
              <div v-if="filteredTo.length === 0 && queryTo !== ''"
                class="relative cursor-default select-none py-2 px-4 text-gray-700">
                Ничего не найдено
              </div>

              <ComboboxOption v-for="person in filteredTo" as="template" :key="person.id" :value="person"
                v-slot="{ selected, active }">
                <li class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{
                  'bg-green-600 text-white': active,
                  'text-gray-900': !active,
                }">
                  <span class="block truncate" :class="{
                    'font-medium': selected,
                    'font-normal': !selected,
                  }">
                    {{  person.to  }}
                  </span>
                  <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{
                    'text-white': active,
                    'text-teal-600': !active,
                  }">
                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </TransitionRoot>
        </div>
      </Combobox>
    </div>
    <div class="text-left">
      <Listbox v-model="selectedPassengers">
        <ListboxLabel>Пассажиры</ListboxLabel>
        <div class="relative mt-1">
          <ListboxButton
            class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-green-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-green-300 sm:text-sm">
            <span class="block truncate">{{ selectedPassengers.id }}</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
              <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </span>
          </ListboxButton>

          <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
            leave-to-class="opacity-0">
            <ListboxOptions
              class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
              <ListboxOption v-slot="{ active, selected }" v-for="person in passengers" :key="person.id" :value="person"
                as="template">
                <li :class="[
                  active ? 'bg-green-100 text-green-900' : 'text-gray-900',
                  'relative cursor-default select-none py-2 pl-10 pr-4',
                ]">
                  <span :class="[
                    selected ? 'font-medium' : 'font-normal',
                    'block truncate',
                  ]">{{ person.id }}</span>
                  <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-600">
                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </li>
              </ListboxOption>
            </ListboxOptions>
          </transition>
        </div>
      </Listbox>
    </div>
    <button @click.prevent="searchTours()"
      class="flex self-end justify-center items-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
      Поиск
    </button>
  </form>
</template>

<script setup lang="ts">
// definePageMeta({
//   layout: "default",
// });
import { ref, computed } from "vue";
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
  ComboboxLabel,
  Listbox,
  ListboxButton,
  ListboxOptions,
  ListboxOption,
  ListboxLabel,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
const route = useRoute()
const router = useRouter()
const toursStore = useToursStore();
const { data: tours } = await useLarafetch("/api/tours");
toursStore.tours = <Tour[]>tours.value;

// const itemsFrom = [
//   { id: 1, name: "Москва", unavailable: false },
//   { id: 2, name: "Санкт-Петербург", unavailable: false },
//   { id: 3, name: "Казань", unavailable: false },
// ];
const itemsFrom = toursStore.tours;

let selectedFrom = ref(itemsFrom[0]);
let queryFrom = ref("");

let filteredFrom = computed(() =>
  queryFrom.value === ""
    ? itemsFrom
    : itemsFrom.filter((person) =>
      person.from
        .toLowerCase()
        .replace(/\s+/g, "")
        .includes(queryFrom.value.toLowerCase().replace(/\s+/g, ""))
    )
);

//========================================================================================================================================================

const itemsTo = toursStore.tours;

let selectedTo = ref(itemsTo[0]);
let queryTo = ref("");

let filteredTo = computed(() =>
  queryTo.value === ""
    ? itemsTo
    : itemsTo.filter((person) =>
      person.to
        .toLowerCase()
        .replace(/\s+/g, "")
        .includes(queryTo.value.toLowerCase().replace(/\s+/g, ""))
    )
);

//========================================================================================================================================================

const passengers = [
  {
    id: 1,
  },
  {
    id: 2,
  },
  {
    id: 3,
  },
  {
    id: 4,
  },
];
const selectedPassengers = ref(passengers[0]);


const searchTours = async () => {

  toursStore.from = selectedFrom.value.from;
  toursStore.to = selectedTo.value.to;
  // console.log(route.query.to)
  if (route.path === '/') {

    router.push(`tours?from=${selectedFrom.value.from}&to=${selectedTo.value.to}`)
  }
  const { data: tours } = await useLarafetch(`/api/tours?from=${selectedFrom.value.from}&to=${selectedTo.value.to}`);
  toursStore.tours = tours
}
</script>
