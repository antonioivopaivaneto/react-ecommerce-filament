import { PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import Navbar from "@/Components/App/Navbar";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function Welcome({
    auth,
    laravelVersion,
    phpVersion,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {


    return (
      <AuthenticatedLayout>
        <Head title="123"/>
        <div className="hero bg-gray-400 h-[300px]">
          <div className="hero-content text-center">
            <div className="max-w-md">
              <h1 className="text-5xl font-bold">Hello there</h1>
              <p className="py-6">
                Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                quasi. In deleniti eaque aut repudiandae et a id nisi.
              </p>
              <button className="btn btn-primary">Get Started</button>
            </div>
          </div>
        </div>

      </AuthenticatedLayout>
    );
}
