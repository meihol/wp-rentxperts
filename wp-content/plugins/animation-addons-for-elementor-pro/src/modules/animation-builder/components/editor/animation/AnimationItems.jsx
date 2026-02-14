import {
  Accordion2,
  AccordionContent2,
  AccordionItem2,
  AccordionTrigger2,
} from "@/components/ui/accordion2";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { AProperties } from "@/config/timelineProperties";
import { IconCopy } from "@/lib/icons";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useEffect, useState } from "react";
import PropertiesControl from "../PropertiesControl";
import { generateUniqueId } from "../../../../../utils/generateUniqueId";
import { useContentStep } from "@/hooks/app.hooks";
import ToolTipWrapper from "@/components/common/ToolTipWrapper";
import DeleteConfirmDialog from "@/components/common/DeleteConfirmDialog";

const AnimationItems = ({ item, timelines }) => {
  const properties = AProperties;
  const { updateAnimationData, duplicateAnimationData, deleteAnimationData } =
    useContentStep();
  const [accValue, setAccValue] = useState([""]);
  const [aTitle, setATitle] = useState(item?.title || "");
  const [aTimeline, setATimeline] = useState(item?.timeline || "");
  const [aAbsoluteTime, setAAbsoluteTime] = useState(item?.absoluteTime || "");
  const [aMethod, setAMethod] = useState(item?.method || "");
  const [aProperties, setAProperties] = useState(item?.properties || []);
  const [applyAnimation, setApplyAnimation] = useState(
    item?.applyAnimation || {}
  );

  useEffect(() => {
    updateAnimationData({
      title: aTitle,
      timeline: aTimeline,
      absoluteTime: aAbsoluteTime,
      method: aMethod,
      applyAnimation,
      properties: aProperties,
      id: item.id,
    });
  }, [aTitle, aTimeline, aAbsoluteTime, aMethod, applyAnimation, aProperties]);

  const addProperties = (data) => {
    const sampleData = {
      id: generateUniqueId(),
      name: data.name,
      value: data.value || data?.default,
      type: data.type,
      unit: data?.unit || "",
      info: data?.info,
      isError: false,
      errorMessage: "",
    };

    const findCustom = aProperties?.find((el) => el.type === "custom");

    if (findCustom) {
      const withoutCustom = aProperties?.filter((el) => el.type !== "custom");

      setAProperties([...withoutCustom, sampleData, findCustom]);
    } else {
      setAProperties((prev) => [...prev, sampleData]);
    }
  };

  const updateProperties = (data, propertyItem) => {
    if (propertyItem?.id) {
      const result = aProperties.map((el) => {
        if (el.id === propertyItem?.id) {
          el.value = data;
          return el;
        } else {
          return el;
        }
      });

      setAProperties(result);
    }
  };

  const deleteProperties = (id) => {
    if (id) {
      const result = aProperties.filter((el) => el.id !== id);
      setAProperties(result);
    }
  };

  const selectClass = () => {
    const iframe = document.getElementById(
      "wcf--animation-builder--animation--preview"
    );
    if (iframe) {
      const win = iframe.contentWindow;
      win.postMessage({ "wcf-animb-selector-status": true });
    }
  };

  return (
    <Accordion2
      type="multiple"
      value={accValue}
      onValueChange={setAccValue}
      className="w-full bg-background-hover border border-border-2 rounded"
    >
      <AccordionItem2 value="animation" className="group">
        <div className="flex justify-between items-center [&>h3]:w-full">
          <AccordionTrigger2>
            <p>{aTitle}</p>
          </AccordionTrigger2>
          <div className="w-[54px]">
            <div className="hidden group-hover:flex justify-center items-center">
              <div
                className="py-2.5 ps-2 pe-[7px] flex justify-center items-center cursor-pointer"
                onClick={() => duplicateAnimationData(item.id)}
              >
                <IconCopy />
              </div>

              <DeleteConfirmDialog
                className="py-2.5 pe-2 ps-[7px] flex justify-center items-center cursor-pointer"
                deleteFn={deleteAnimationData}
                id={item.id}
              />
            </div>
          </div>
        </div>
        <AccordionContent2 className="px-2 py-2.5 border-t border-border-2">
          <div>
            <div className="pb-2.5 border-b border-border-2 flex flex-col gap-2.5">
              <div className="grid grid-cols-3 justify-between items-center gap-2">
                <div className="flex items-center gap-1">
                  <h3 className="text-xs text-text">Title</h3>
                  <ToolTipWrapper text={"Animation title"} />
                </div>
                <div className="col-span-2">
                  <Input
                    value={aTitle}
                    onChange={(e) => setATitle(e.target.value)}
                    placeholder="Animation _1"
                    className="h-[28px]"
                  />
                </div>
              </div>
              <div className="grid grid-cols-3 justify-between items-center gap-2">
                <div className="flex items-center gap-1">
                  <h3 className="text-xs text-text">Timeline</h3>
                  <ToolTipWrapper text={"Select timeline"} />
                </div>
                <div className="col-span-2">
                  <Select value={aTimeline} onValueChange={setATimeline}>
                    <SelectTrigger>
                      <SelectValue placeholder="Select a timeline" />
                    </SelectTrigger>
                    {timelines?.length ? (
                      <SelectContent>
                        <SelectGroup>
                          {timelines.map((item) => (
                            <SelectItem key={item.id} value={item.title}>
                              {item.title}
                            </SelectItem>
                          ))}
                        </SelectGroup>
                      </SelectContent>
                    ) : (
                      ""
                    )}
                  </Select>
                </div>
              </div>
              <div className="grid grid-cols-3 justify-between items-center gap-2">
                <div className="flex items-center gap-1">
                  <h3 className="text-xs text-text">Absolute Time</h3>
                  <ToolTipWrapper text={"Add Absolute Time"} />
                </div>
                <div className="col-span-2">
                  <Input
                    value={aAbsoluteTime}
                    onChange={(e) => setAAbsoluteTime(e.target.value)}
                    placeholder="3"
                    className="h-[28px]"
                  />
                </div>
              </div>
              <div className="grid grid-cols-3 justify-between items-center gap-2">
                <div className="flex items-center gap-1">
                  <h3 className="text-xs text-text">Method</h3>
                  <ToolTipWrapper text={"Select method"} />
                </div>
                <div className="col-span-2">
                  <Select value={aMethod} onValueChange={setAMethod}>
                    <SelectTrigger>
                      <SelectValue placeholder="Select method" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectGroup>
                        <SelectItem value="to">To</SelectItem>
                        <SelectItem value="from">From</SelectItem>
                        {/* <SelectItem value="fromTo">From To</SelectItem> */}
                        <SelectItem value="set">Set</SelectItem>
                      </SelectGroup>
                    </SelectContent>
                  </Select>
                </div>
              </div>
            </div>

            {/* apply animation  */}
            <div className="py-2.5 border-b border-border-2 flex flex-col gap-2.5">
              <div>
                <h3 className="text-text-2 mb-1.5">Applies on</h3>
                <div className="flex flex-col gap-2.5">
                  <div className="flex justify-between items-center gap-2">
                    <div className="w-[70px]">
                      <h3 className="text-xs text-text-2">Class</h3>
                    </div>
                    <div className="flex-1">
                      <Input
                        placeholder="<h1 - heading>"
                        value={applyAnimation.className}
                        onChange={(e) =>
                          setApplyAnimation((prev) => ({
                            ...prev,
                            className: e.target.value,
                          }))
                        }
                        className="h-[28px] bg-background-hover text-text-2"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* properties  */}
            <div className="py-2.5 border-b border-border-2">
              <PropertiesControl
                properties={properties}
                selectedProperties={aProperties}
                addProperties={addProperties}
                updateProperties={updateProperties}
                deleteProperties={deleteProperties}
                dropdownHeight="h-96"
              />
            </div>
            <div className="flex justify-end items-center gap-1.5 pt-2.5">
              <Button variant="secondary" onClick={() => setAccValue([""])}>
                Close
              </Button>
            </div>
          </div>
        </AccordionContent2>
      </AccordionItem2>
    </Accordion2>
  );
};

export default AnimationItems;
