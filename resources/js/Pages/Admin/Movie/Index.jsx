import Authenticated from "@/Layouts/Authenticated/index"
import PrimaryButton from "@/Components/PrimaryButton"
import FlashMessage from "@/Components/FlashMessage"
import { Link } from "@inertiajs/react"

export default function Index({auth, flashMessage}) {
  return (
  <>
    <Authenticated auth={auth}>
      <Link href={route('admin.dashboard.movie.create')}>
        <PrimaryButton
          type="button"
          className="w-40 mb-8"
          >
          Add New Movie
        </PrimaryButton>
      </Link>
      {flashMessage?.message && <FlashMessage message={flashMessage.message} />}
    </Authenticated>
  </>
  )
}