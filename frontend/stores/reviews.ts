import { defineStore } from 'pinia'

export interface Review {
    id: number;
    name: string;
    content: string;
    created_at: string;
}

export const useReviewsStore = defineStore('reviews', {
    state: () => ({ reviews: [] as Review[] }),
    getters: {
      getReviews:  (state) => {
       
        return state.reviews
      },
    },
    actions: {
      addReview(review: Review) {
        this.reviews.push(review)
      },
      removeReview(review: Review) {
        this.reviews = this.reviews.filter((value)=>{
          return value.id !== review.id
        })
      },
    },
  })