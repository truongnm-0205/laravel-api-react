import { Dispatch, SetStateAction } from "react";
import { StudentType } from "../../api";

export type StudentTableType = {
    data: StudentType[],
    onOpen: ()=>void,
    setIdStudent:Dispatch<SetStateAction<number|undefined>>
}