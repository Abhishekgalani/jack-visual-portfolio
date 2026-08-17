import { useRef } from "react";
import { motion, useScroll, useTransform, type MotionValue } from "framer-motion";
import { FadeIn } from "./FadeIn";
import { LiveProjectButton } from "./buttons";

const img = (u: string) =>
  `https://images.higgs.ai/?default=1&output=webp&url=https%3A%2F%2Fd8j0ntlcm91z4.cloudfront.net%2Fuser_38xzZboKViGWJOttwIXH07lWA1P%2F${u}&w=1280&q=85`;

const PROJECTS = [
  {
    n: "01",
    name: "Nextlevel Studio",
    category: "Client",
    col1: [
      img("hf_20260412_055344_5eff02e0-87a5-41ce-b64f-eb08da8f33db.png"),
      img("hf_20260412_055431_11d841fd-8b41-46a5-82e4-b04f2407a7d8.png"),
    ],
    col2: img("hf_20260412_055451_e317bf2d-28d4-48cc-86b0-6f72f25b6327.png"),
  },
  {
    n: "02",
    name: "Aura Brand Identity",
    category: "Personal",
    col1: [
      img("hf_20260412_055654_911201c5-36d9-4bc6-bac7-331adfce159f.png"),
      img("hf_20260412_055723_5ceda0b8-d9c2-4665-b2e3-83ba19ba76d1.png"),
    ],
    col2: img("hf_20260412_055753_adc5dcbd-a8e6-49c0-b43a-9b030d835cea.png"),
  },
  {
    n: "03",
    name: "Solaris Digital",
    category: "Client",
    col1: [
      img("hf_20260412_055759_963cfb0b-4bd1-4b0f-9d0a-09bd6cf95b2f.png"),
      img("hf_20260412_060108_438f781a-9846-4dcc-89ab-c4e6cb830f5b.png"),
    ],
    col2: img("hf_20260412_055818_9d062121-ad7e-46b9-999a-1a6a692ef1ee.png"),
  },
];

function ProjectCard({
  project,
  index,
  total,
  progress,
}: {
  project: (typeof PROJECTS)[number];
  index: number;
  total: number;
  progress: MotionValue<number>;
}) {
  const targetScale = 1 - (total - 1 - index) * 0.03;
  const start = index / total;
  const scale = useTransform(progress, [start, 1], [1, targetScale]);

  return (
    <div className="sticky top-24 md:top-32 flex h-[85vh] items-start justify-center">
      <motion.div
        style={{ scale, top: `${index * 28}px`, backgroundColor: "#0C0C0C" }}
        className="relative w-full rounded-[40px] sm:rounded-[50px] md:rounded-[60px] border-2 border-[#D7E2EA] p-4 sm:p-6 md:p-8"
      >
        <div className="flex flex-wrap items-center justify-between gap-4">
          <div className="flex items-center gap-4 sm:gap-6 md:gap-8">
            <span
              className="font-black leading-none text-[#D7E2EA]"
              style={{ fontSize: "clamp(3rem, 10vw, 140px)" }}
            >
              {project.n}
            </span>
            <div className="flex flex-col gap-2">
              <span className="text-xs sm:text-sm uppercase tracking-widest text-[#D7E2EA]/60">
                {project.category}
              </span>
              <h3
                className="font-medium uppercase leading-none text-[#D7E2EA]"
                style={{ fontSize: "clamp(1rem, 2.2vw, 2.1rem)" }}
              >
                {project.name}
              </h3>
            </div>
          </div>
          <LiveProjectButton />
        </div>

        <div className="mt-6 flex gap-3 sm:gap-4">
          <div className="flex w-[40%] flex-col gap-3 sm:gap-4">
            <img
              src={project.col1[0]}
              alt={`${project.name} preview 1`}
              loading="lazy"
              className="w-full rounded-[40px] sm:rounded-[50px] md:rounded-[60px] object-cover"
              style={{ height: "clamp(130px, 16vw, 230px)" }}
            />
            <img
              src={project.col1[1]}
              alt={`${project.name} preview 2`}
              loading="lazy"
              className="w-full rounded-[40px] sm:rounded-[50px] md:rounded-[60px] object-cover"
              style={{ height: "clamp(160px, 22vw, 340px)" }}
            />
          </div>
          <div className="w-[60%]">
            <img
              src={project.col2}
              alt={`${project.name} preview 3`}
              loading="lazy"
              className="h-full w-full rounded-[40px] sm:rounded-[50px] md:rounded-[60px] object-cover"
            />
          </div>
        </div>
      </motion.div>
    </div>
  );
}

export function ProjectsSection() {
  const containerRef = useRef<HTMLDivElement>(null);
  const { scrollYProgress } = useScroll({
    target: containerRef,
    offset: ["start start", "end end"],
  });

  return (
    <section
      id="projects"
      className="relative z-10 -mt-10 sm:-mt-12 md:-mt-14 rounded-t-[40px] sm:rounded-t-[50px] md:rounded-t-[60px] px-5 sm:px-8 md:px-10 py-20 sm:py-24 md:py-32"
      style={{ backgroundColor: "#0C0C0C" }}
    >
      <FadeIn
        as="h2"
        delay={0}
        y={40}
        className="hero-heading text-center font-black uppercase leading-none tracking-tight mb-16 sm:mb-20 md:mb-24"
        style={{ fontSize: "clamp(3rem, 12vw, 160px)" }}
      >
        Project
      </FadeIn>

      <div ref={containerRef} className="mx-auto max-w-6xl">
        {PROJECTS.map((p, i) => (
          <ProjectCard
            key={p.n}
            project={p}
            index={i}
            total={PROJECTS.length}
            progress={scrollYProgress}
          />
        ))}
      </div>
    </section>
  );
}
