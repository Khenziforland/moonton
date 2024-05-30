import Flickity from "react-flickity-component"
import { Head } from "@inertiajs/react"
import Authenticated from "@/Layouts/Authenticated/index"
import FeaturedMovie from "@/Components/FeaturedMovie"
import MovieCard from "@/Components/MovieCard"

export default function Dashboard() {
  const flickityOptions = {
      "cellAlign": "left",
      "contain": true,
      "groupCells": 1,
      "wrapAround": false,
      "pageDots": false,
      "prevNextButtons": false,
      "draggable": ">1"
  }
  return <Authenticated>
    <Head>
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    </Head>
        <div>
          <div className="font-semibold text-[22px] text-black mb-4">
            Featured Movies
          </div>

          <Flickity className="gap-[30px]" options={flickityOptions}>
              {[1,2,3,4].map(i => (
                <FeaturedMovie 
                  key={i} 
                  slug="the-batman-in-love"
                  name={`The Batman in Love ${i}`}
                  category="Action"
                  thumbnail="https://static1.moviewebimages.com/wordpress/wp-content/uploads/2022/08/The-Batman-2022.png?q=50&fit=crop&w=1500&dpr=1.5"
                  rating={i + 1}
                />
              ))}
          </Flickity>
      </div>

      <div className="mt-[50px]">
          <div className="font-semibold text-[22px] text-black mb-4">
              Browse
          </div>

          <Flickity className="gap-[30px]" options={flickityOptions}>
              {[1,2,3,4,5,6].map(i => (
                <MovieCard 
                  key={i} 
                  slug="meong-golden"
                  name={`Meong Golden ${i}`}
                  category="Comedy"
                  thumbnail="https://i.pinimg.com/736x/a7/06/c5/a706c5dcd157e545c34a393c16201ca8.jpg"
                />
              ))}

              
          </Flickity>
      </div>


  </Authenticated>
}