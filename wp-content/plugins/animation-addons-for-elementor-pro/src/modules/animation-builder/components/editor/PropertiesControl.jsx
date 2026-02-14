import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { InputWithShape } from "@/components/ui/input-with-shape";
import { Button } from "@/components/ui/button";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { IconPlus, IconPlus2 } from "@/lib/icons";
import { Input } from "../ui/input";
import { ScrollArea } from "@/components/ui/scroll-area";
import { Textarea } from "../ui/textarea";
import { cn } from "@/lib/utils";
import ToolTipWrapper from "../common/ToolTipWrapper";
import DeleteConfirmDialog from "../common/DeleteConfirmDialog";

const easeConfig = [
  "power2.out",
  "power2.in",
  "power2.inOut",
  "power3.out",
  "power3.in",
  "power3.inOut",
  "power4.out",
  "power4.in",
  "power4.inOut",
  "back",
  "bounce",
  "circ",
  "elastic",
  "expo",
  "sine",
  "steps",
  "rough",
  "slow",
];

const PropertiesControl = ({
  properties,
  selectedProperties,
  addProperties,
  updateProperties,
  deleteProperties,
  dropdownHeight = "h-72",
}) => {
  const generateField = (item) => {
    if (item.type === "boolean") {
      return (
        <Select
          value={item.value}
          onValueChange={(value) => updateProperties(value, item)}
        >
          <SelectTrigger className="min-w-[90px]">
            <SelectValue placeholder="Option" className="line-clamp-1" />
          </SelectTrigger>
          <SelectContent className="min-w-[90px]">
            <SelectGroup>
              <SelectItem value={"true"}>True</SelectItem>
              <SelectItem value={"false"}>False</SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      );
    } else if (item.type === "number") {
      if (item?.unit === "s") {
        return (
          <InputWithShape
            value={item?.value}
            onChange={(e) => updateProperties(e.target.value, item)}
            placeholder="add value"
          />
        );
      } else {
        return (
          <Input
            value={item?.value}
            type="number"
            onChange={(e) => updateProperties(e.target.value, item)}
            placeholder="add value"
            className="no-spinner"
          />
        );
      }
    } else if (item.type === "string") {
      return (
        <Input
          value={item?.value}
          onChange={(e) => updateProperties(e.target.value, item)}
          placeholder="add value"
        />
      );
    } else if (item.type === "ease") {
      return (
        <Select
          value={item.value}
          onValueChange={(value) => updateProperties(value, item)}
        >
          <SelectTrigger className="min-w-[90px]">
            <SelectValue placeholder="Option" />
          </SelectTrigger>
          <SelectContent className="min-w-[90px]">
            <SelectGroup>
              {easeConfig?.map((el) => (
                <SelectItem key={el} value={el}>
                  {el}
                </SelectItem>
              ))}
            </SelectGroup>
          </SelectContent>
        </Select>
      );
    } else if (item.type === "color") {
      return (
        <div className="flex items-center gap-1">
          <Input
            type="color"
            className="w-[28px] p-0 px-[2px]"
            value={item?.value}
            onChange={(e) => updateProperties(e.target.value, item)}
          />
          <Input
            value={item?.value}
            onChange={(e) => updateProperties(e.target.value, item)}
            placeholder="add value"
          />
        </div>
      );
    } else if (item.type === "pinType") {
      return (
        <Select
          defaultValue="transform"
          value={item.value}
          onValueChange={(value) => updateProperties(value, item)}
        >
          <SelectTrigger className="min-w-[90px]">
            <SelectValue placeholder="Option" />
          </SelectTrigger>
          <SelectContent className="min-w-[90px]">
            <SelectItem value="transform">transform</SelectItem>
            <SelectItem value="fixed">fixed</SelectItem>
          </SelectContent>
        </Select>
      );
    } else {
      <></>;
    }
  };

  const selectableProperties = properties?.filter((el) => {
    const common = selectedProperties?.find(
      (el2) => el2.name === el.name && el2.type === el.type
    );
    if (!common) {
      return el;
    }
  });

  return (
    <div className="flex flex-col gap-2.5">
      <div className="flex justify-between items-center gap-1.5">
        <h3>Add Properties</h3>
        <div>
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <div className="cursor-pointer flex justify-center items-center">
                <IconPlus2 size="14" />
              </div>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-[180px]" align="end">
              <ScrollArea className={cn(dropdownHeight)}>
                {selectableProperties?.map((el) => (
                  <DropdownMenuItem
                    key={el?.name}
                    onClick={() => addProperties(el)}
                  >
                    {el.name}
                  </DropdownMenuItem>
                ))}
              </ScrollArea>
            </DropdownMenuContent>
          </DropdownMenu>
        </div>
      </div>
      {selectedProperties?.length ? (
        <div className="flex flex-col gap-2">
          {selectedProperties?.map((item) => (
            <div key={item?.id}>
              {item.type === "custom" ? (
                <div className="flex flex-col gap-2">
                  <div className="w-[86px] mr-2 flex items-center gap-1">
                    <h3 className="text-xs text-text-2 line-clamp-1 capitalize">
                      {item?.name}
                    </h3>
                    {item?.info ? <ToolTipWrapper text={item?.info} /> : ""}
                  </div>
                  <div className="flex justify-between">
                    <div className="flex-1 mr-1.5">
                      <Textarea
                        value={item?.value}
                        onChange={(e) =>
                          updateProperties(e.target.value, item)
                        }
                        placeholder="x:1, y:2"
                        className="resize-none"
                      />
                    </div>

                    <DeleteConfirmDialog
                      className="flex justify-center items-center cursor-pointer"
                      deleteFn={deleteProperties}
                      id={item?.id}
                    />
                  </div>
                </div>
              ) : (
                <div className="grid grid-cols-2 gap-2 justify-between items-center">
                  <div className="flex items-center gap-1">
                    <h3 className="text-xs text-text-2 capitalize">
                      {item?.name}
                    </h3>
                    {item?.info ? <ToolTipWrapper text={item?.info} /> : ""}
                  </div>
                  <div className="flex items-center gap-1.5">
                    <div className="flex-1">{generateField(item)}</div>

                    <DeleteConfirmDialog
                      className="flex justify-center items-center cursor-pointer"
                      deleteFn={deleteProperties}
                      id={item?.id}
                    />
                  </div>
                </div>
              )}
              
            </div>
          ))}
        </div>
      ) : (
        ""
      )}
      {selectedProperties?.length ? (
        <div>
          <DropdownMenu>
            <DropdownMenuTrigger asChild>
              <Button
                variant="tertiary"
                size="tertiary"
                className="[&_svg]:size-2.5"
              >
                <IconPlus className={"fill-text"} /> Add New
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent className="w-[180px]" align="start">
              <ScrollArea className={cn(dropdownHeight)}>
                {selectableProperties?.map((el) => (
                  <DropdownMenuItem
                    key={el?.name}
                    onClick={() => addProperties(el)}
                  >
                    {el?.name}
                  </DropdownMenuItem>
                ))}
              </ScrollArea>
            </DropdownMenuContent>
          </DropdownMenu>
        </div>
      ) : (
        ""
      )}
    </div>
  );
};

export default PropertiesControl;
