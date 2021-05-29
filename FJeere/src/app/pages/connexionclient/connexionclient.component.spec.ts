import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConnexionclientComponent } from './connexionclient.component';

describe('ConnexionclientComponent', () => {
  let component: ConnexionclientComponent;
  let fixture: ComponentFixture<ConnexionclientComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ConnexionclientComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ConnexionclientComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
