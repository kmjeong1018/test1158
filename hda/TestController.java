package com.newriver.hondakorea_bo.controller.test;

import com.newriver.hondakorea_bo.model.TestDTO;
import com.newriver.hondakorea_bo.model.SearchDTO;
import com.newriver.hondakorea_bo.paging.PagingResponse;
import com.newriver.hondakorea_bo.service.TestService;
import lombok.extern.log4j.Log4j2;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;

@Controller
@Log4j2
public class TestController {

    @Autowired
    private TestService testService;

    @GetMapping("/testList")
    public String noticeList(@ModelAttribute("params") final SearchDTO params, Model model) {
        log.info("===> /testList params: "+ params.toString());

        PagingResponse<TestDTO> response = testService.getAllTest(params);

        testService.getAllTest(params);
        model.addAttribute("response", response);
        log.info("response: "+ response);

        return "bbs/test_list";
    }
}
