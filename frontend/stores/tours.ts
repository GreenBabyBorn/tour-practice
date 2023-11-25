import { defineStore } from 'pinia'

export interface Tour {
    id: number;
    name: string;
    to: string,
    from: string,
    dateTo: string,
    dateFrom: string,
    cost: number,
    photos: [],
    created_at: string;
    updated_at: string;
}

export const useToursStore = defineStore('tours', {
    state: () => ({
        tours: [] as Tour[],
        to: '',
        from: ''
    }),
    getters: {
        getTours: (state) => {
            return state.tours
        },
    },
    actions: {
        addTour(tours: Tour) {
            this.tours.push(tours)
        },
        removeTour(tours: Tour) {
            this.tours = this.tours.filter((value) => {
                return value.id !== tours.id
            })
        },
    },
})