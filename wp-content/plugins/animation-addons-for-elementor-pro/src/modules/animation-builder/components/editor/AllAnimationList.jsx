import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";
import { useAnimationControl, useContentStep } from "@/hooks/app.hooks";
import { IconCopy } from "@/lib/icons";
import DeleteConfirmDialog from "../common/DeleteConfirmDialog";

const AllAnimationList = () => {
  const { allAnimation, duplicateAnimation, deleteAnimation } =
    useAnimationControl();
  const { setContentStep } = useContentStep();

  return (
    <Accordion
      type="single"
      defaultValue="allAnimation"
      collapsible
      className="w-full p-3"
    >
      <AccordionItem value="allAnimation">
        <AccordionTrigger>Animations</AccordionTrigger>
        <AccordionContent className="mt-3">
          <div className="flex flex-col gap-[7px]">
            {allAnimation?.map((animation) => (
              <div
                key={animation.id}
                className="group flex justify-between items-center gap-1.5 p-2 pe-0 border border-border-2 rounded hover:bg-background-hover"
              >
                <div
                  className="flex flex-1 flex-col gap-1.5 cursor-pointer"
                  onClick={() => setContentStep({ step: 2, data: animation })}
                >
                  <h3 className="text-xs text-text-2 group-hover:text-text font-medium">
                    {animation.title}
                  </h3>
                  <p className="text-[11.5px] text-text-3 group-hover:text-text-2 leading-[1.13] line-clamp-1">
                    Applied on element
                  </p>
                </div>
                <div className="w-[54px]">
                  <div className="hidden group-hover:flex justify-center items-center">
                    <div
                      className="py-2.5 ps-2 pe-[7px] flex justify-center items-center cursor-pointer"
                      onClick={() => duplicateAnimation(animation.id)}
                    >
                      <IconCopy />
                    </div>

                    <DeleteConfirmDialog
                      className="py-2.5 pe-2 ps-[7px] flex justify-center items-center cursor-pointer"
                      deleteFn={deleteAnimation}
                      id={animation.id}
                    />
                  </div>
                </div>
              </div>
            ))}
          </div>
        </AccordionContent>
      </AccordionItem>
    </Accordion>
  );
};

export default AllAnimationList;
