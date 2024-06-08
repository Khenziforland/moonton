import Authenticated from "@/Layouts/Authenticated/index"
import PrimaryButton from "@/Components/PrimaryButton"
import FlashMessage from "@/Components/FlashMessage"
import { Head, Link, useForm } from "@inertiajs/react"

export default function Index({auth, flashMessage, movies}) {
  const {delete:destroy, put} = useForm();

  return (
  <>
    <Authenticated auth={auth}>
      <Head title="List of Movies" />
      <Link href={route('admin.dashboard.movie.create')}>
        <div className="w-40 mb-8">
        <PrimaryButton
          type="button"
          >
          Add New Movie
        </PrimaryButton>
        </div>
      </Link>

      {flashMessage?.message && <FlashMessage message={flashMessage.message} />}

      <table className="table-fixed w-full text-center">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Rating</th>
            <th colSpan={2}>Action</th>
          </tr>
        </thead>
        <tbody>
          {movies.map(movie => (
            <tr key={movie.id}>
              <td>
                <img src={`/storage/${movie.thumbnail}`} className="w-32 rounded-md" />
              </td>
              <td>{movie.name}</td>
              <td>{movie.category}</td>
              <td>{movie.rating.toFixed(1)}</td>
              <td>
                <Link href={route('admin.dashboard.movie.edit', movie.id)}>
                  <PrimaryButton type="button" variant="warning">
                    Edit
                  </PrimaryButton>
                </Link>
              </td>
              <td>
                <div onClick={() => {
                  movie.deleted_at ? put(route('admin.dashboard.movie.restore', movie.id)) :
                  destroy(route("admin.dashboard.movie.destroy", movie.id));
                }}>
                  <PrimaryButton type="button" variant="danger">
                    {movie.deleted_at ? "Restore" : "Delete"}
                  </PrimaryButton>
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </Authenticated>
  </>
  )
}