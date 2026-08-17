import { FadeIn } from "./FadeIn";

const SERVICES = [
  {
    n: "01",
    name: "3D Modeling",
    desc: "Creation of detailed objects, characters, or environments tailored to specific client needs, ideal for games, products, and visualizations.",
  },
  {
    n: "02",
    name: "Rendering",
    desc: "High-quality, photorealistic renders that showcase designs with custom lighting, textures, and materials to bring concepts to life.",
  },
  {
    n: "03",
    name: "Motion Design",
    desc: "Dynamic animations and motion graphics that add energy and storytelling to brands, products, and digital experiences.",
  },
  {
    n: "04",
    name: "Branding",
    desc: "Crafting cohesive visual identities — from logos to full brand systems — that communicate a clear and memorable presence.",
  },
  {
    n: "05",
    name: "Web Design",
    desc: "Designing clean, modern, and conversion-focused websites with attention to layout, typography, and user experience.",
  },
];

export function ServicesSection() {
  return (
    <section
      id="price"
      className="rounded-t-[40px] sm:rounded-t-[50px] md:rounded-t-[60px] px-5 sm:px-8 md:px-10 py-20 sm:py-24 md:py-32"
      style={{ backgroundColor: "#FFFFFF" }}
    >
      <FadeIn
        as="h2"
        delay={0}
        y={40}
        className="text-center font-black uppercase leading-none tracking-tight mb-16 sm:mb-20 md:mb-28"
        style={{ fontSize: "clamp(3rem, 12vw, 160px)", color: "#0C0C0C" }}
      >
        Services
      </FadeIn>

      <div className="mx-auto max-w-5xl">
        {SERVICES.map((s, i) => (
          <FadeIn
            key={s.n}
            delay={i * 0.1}
            y={30}
            className="flex items-start gap-5 sm:gap-8 md:gap-12 py-8 sm:py-10 md:py-12"
            style={{
              borderTop: i === 0 ? "1px solid rgba(12, 12, 12, 0.15)" : undefined,
              borderBottom: "1px solid rgba(12, 12, 12, 0.15)",
            }}
          >
            <span
              className="font-black leading-none"
              style={{ fontSize: "clamp(3rem, 10vw, 140px)", color: "#0C0C0C" }}
            >
              {s.n}
            </span>
            <div className="flex flex-col gap-3 pt-1">
              <h3
                className="font-medium uppercase leading-none"
                style={{ fontSize: "clamp(1rem, 2.2vw, 2.1rem)", color: "#0C0C0C" }}
              >
                {s.name}
              </h3>
              <p
                className="max-w-2xl font-light leading-relaxed"
                style={{
                  fontSize: "clamp(0.85rem, 1.6vw, 1.25rem)",
                  color: "#0C0C0C",
                  opacity: 0.6,
                }}
              >
                {s.desc}
              </p>
            </div>
          </FadeIn>
        ))}
      </div>
    </section>
  );
}
